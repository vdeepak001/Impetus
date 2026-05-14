@extends('layouts.app')

@section('content')
    <livewire:super-admin.users-list.index />
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('usersList', (usersListBaseUrl, csrfToken) => ({
            usersListBaseUrl,
            csrfToken,
            detailOpen: false,
            detailUser: null,
            detailForm: {},
            detailSubmitting: false,
            paymentOpen: false,
            paymentUserId: null,
            courseOpen: false,
            courseUserId: null,
            courseOrders: [],
            courseLoading: false,
            performanceOpen: false,
            performanceLoading: false,
            performanceChart: null,
            performanceOrders: [],
            selectedPerformanceModule: 'all',

            paymentCourses: [],
            paymentModes: [],
            paymentInfoMessage: '',
            paymentLoading: false,
            paymentSubmitting: false,
            paymentError: '',
            paymentForm: {
                course_detail_id: '',
                payment_mode: '',
                start_date: '',
                end_date: '',
                remarks: '',
            },
            init() {
                this.$watch('paymentForm.course_detail_id', () => this.updateEndDate());
                this.$watch('paymentForm.start_date', () => this.updateEndDate());
                this.$watch('selectedPerformanceModule', () => {
                    if (this.performanceOrders.length > 0) {
                        this.renderPerformanceChart(this.performanceOrders);
                    }
                });
            },
            todayISO() {
                return new Date().toISOString().slice(0, 10);
            },
            todayPlusDaysISO(days, baseDate = null) {
                const d = baseDate ? new Date(baseDate) : new Date();
                d.setDate(d.getDate() + parseInt(days));
                const y = d.getFullYear();
                const m = String(d.getMonth() + 1).padStart(2, '0');
                const day = String(d.getDate()).padStart(2, '0');
                return `${y}-${m}-${day}`;
            },
            updateEndDate() {
                if (! this.paymentForm.course_detail_id || ! this.paymentForm.start_date) return;
                const course = this.paymentCourses.find(c => String(c.id) === String(this.paymentForm.course_detail_id));
                const days = course ? (parseInt(course.valid_days) || 0) : 0;
                const finalDays = days > 0 ? days : 60;
                this.paymentForm.end_date = this.todayPlusDaysISO(finalDays, this.paymentForm.start_date);
            },
            openDetail(user) {
                if (this.paymentOpen) this.closePayment();
                this.detailUser = user;
                this.detailForm = { ...user };
                
                // Format date_of_birth to YYYY-MM-DD for the date input
                if (this.detailForm.date_of_birth) {
                    const d = new Date(this.detailForm.date_of_birth);
                    if (!isNaN(d)) {
                        this.detailForm.date_of_birth = d.toISOString().split('T')[0];
                    }
                }
                
                this.detailOpen = true;
                document.body.style.overflow = 'hidden';
            },
            closeDetail() {
                this.detailOpen = false;
                this.detailUser = null;
                this.detailForm = {};
                if (! this.paymentOpen && ! this.courseOpen && ! this.performanceOpen) document.body.style.overflow = 'unset';
            },

            async submitDetailUpdate() {
                if (this.detailSubmitting) return;
                this.detailSubmitting = true;

                try {
                    const res = await fetch(this.usersListBaseUrl + '/' + this.detailUser.id, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': this.csrfToken,
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                        body: JSON.stringify(this.detailForm),
                    });

                    const data = await res.json();
                    if (! res.ok) throw new Error(data.message || 'Update failed');

                    window.dispatchEvent(new CustomEvent('notify', {
                        detail: { message: 'User profile updated successfully.', title: 'Success', variant: 'success' }
                    }));

                    // Refresh Livewire component to show updated data in the table
                    if (window.Livewire) {
                        const lw = window.Livewire.find(document.querySelector('[wire\\:id]').getAttribute('wire:id'));
                        if (lw) lw.$refresh();
                    }
                    
                    this.closeDetail();
                } catch (e) {
                    window.dispatchEvent(new CustomEvent('notify', {
                        detail: { message: e.message, title: 'Error', variant: 'error' }
                    }));
                } finally {
                    this.detailSubmitting = false;
                }
            },
            resetPaymentForm() {
                this.paymentForm = {
                    course_detail_id: '',
                    payment_mode: '',
                    start_date: this.todayISO(),
                    end_date: '',
                    remarks: '',
                };
                this.paymentError = '';
            },
            async openPayment(userId) {
                if (this.detailOpen) this.closeDetail();
                this.paymentUserId = userId;
                this.resetPaymentForm();
                this.paymentOpen = true;
                this.paymentCourses = [];
                this.paymentModes = [];
                this.paymentInfoMessage = '';
                document.body.style.overflow = 'hidden';
                await this.loadPaymentCourses();
            },
            closePayment() {
                this.paymentOpen = false;
                this.paymentUserId = null;
                this.paymentCourses = [];
                this.paymentModes = [];
                this.paymentLoading = false;
                if (! this.detailOpen && ! this.courseOpen) document.body.style.overflow = 'unset';
            },
            async openCourse(userId) {
                if (this.detailOpen) this.closeDetail();
                if (this.paymentOpen) this.closePayment();
                this.courseUserId = userId;
                this.courseOpen = true;
                this.courseOrders = [];
                document.body.style.overflow = 'hidden';
                this.courseLoading = true;
                try {
                    const res = await fetch(this.usersListBaseUrl + '/' + userId + '/purchased-courses', {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                        credentials: 'same-origin',
                    });
                    const data = await res.json();
                    this.courseOrders = data.orders || [];
                } catch (e) {
                    console.error('Failed to load courses', e);
                } finally {
                    this.courseLoading = false;
                }
            },
            closeCourse() {
                this.courseOpen = false;
                this.courseUserId = null;
                this.courseOrders = [];
                if (! this.detailOpen && ! this.paymentOpen && ! this.performanceOpen) document.body.style.overflow = 'unset';
            },
            async openPerformance(userId) {
                if (this.detailOpen) this.closeDetail();
                if (this.paymentOpen) this.closePayment();
                if (this.courseOpen) this.closeCourse();
                
                this.performanceOpen = true;
                this.performanceLoading = true;
                document.body.style.overflow = 'hidden';

                try {
                    const res = await fetch(this.usersListBaseUrl + '/' + userId + '/purchased-courses', {
                        headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                        credentials: 'same-origin',
                    });
                    const data = await res.json();
                    const orders = data.orders || [];
                    this.performanceOrders = orders;
                    
                    // Default to 'all' to show everything
                    if (orders.length > 0) {
                        this.selectedPerformanceModule = 'all';
                    } else {
                        this.selectedPerformanceModule = 'none';
                    }

                    this.$nextTick(() => {
                        this.renderPerformanceChart(orders);
                    });
                } catch (e) {
                    console.error('Failed to load performance data', e);
                } finally {
                    this.performanceLoading = false;
                }
            },
            closePerformance() {
                this.performanceOpen = false;
                if (this.performanceChart) {
                    this.performanceChart.destroy();
                    this.performanceChart = null;
                }
                if (! this.detailOpen && ! this.paymentOpen && ! this.courseOpen) document.body.style.overflow = 'unset';
            },
            renderPerformanceChart(allOrders) {
                const chartEl = document.querySelector('#performanceChart');
                if (!chartEl) return;

                let orders = allOrders;
                if (this.selectedPerformanceModule !== 'all') {
                    orders = allOrders.filter(o => String(o.id) === String(this.selectedPerformanceModule));
                }

                const categories = orders.map(o => `${o.course_name} (${o.purchase_date})`);
                const preScores = orders.map(o => o.scores.pre);
                const mockScores = orders.map(o => o.scores.mock);
                const finalScores = orders.map(o => o.scores.final);

                const options = {
                    series: [
                        { name: 'Pre-Test', data: preScores },
                        { name: 'Mock Test', data: mockScores },
                        { name: 'Final Test', data: finalScores }
                    ],
                    chart: {
                        type: 'bar',
                        height: 350,
                        toolbar: { show: false },
                        fontFamily: 'Outfit, sans-serif'
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '55%',
                            borderRadius: 4
                        },
                    },
                    dataLabels: { enabled: false },
                    stroke: { show: true, width: 2, colors: ['transparent'] },
                    xaxis: { categories: categories },
                    yaxis: { 
                        title: { text: 'Score (%)' },
                        max: 100
                    },
                    fill: { opacity: 1 },
                    colors: ['#465fff', '#10b981', '#f59e0b'],
                    tooltip: {
                        y: { formatter: (val) => val + "%" }
                    },
                    legend: { position: 'top' }
                };

                if (this.performanceChart) this.performanceChart.destroy();
                this.performanceChart = new ApexCharts(chartEl, options);
                this.performanceChart.render();
            },
            async loadPaymentCourses() {
                this.paymentLoading = true;
                this.paymentError = '';
                try {
                    const res = await fetch(this.usersListBaseUrl + '/' + this.paymentUserId + '/state-courses', {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                        credentials: 'same-origin',
                    });
                    const data = await res.json();
                    this.paymentCourses = data.courses || [];
                    this.paymentModes = data.payment_modes || [];
                    this.paymentInfoMessage = data.message || '';
                    if (this.paymentModes.length && ! this.paymentForm.payment_mode) {
                        this.paymentForm.payment_mode = this.paymentModes[0].value;
                    }
                    if (this.paymentCourses.length && ! this.paymentForm.course_detail_id) {
                        this.paymentForm.course_detail_id = String(this.paymentCourses[0].id);
                    }
                    this.updateEndDate();
                } catch (e) {
                    this.paymentError = 'Could not load modules. Please try again.';
                } finally {
                    this.paymentLoading = false;
                }
            },
            async submitPayment() {
                this.paymentSubmitting = true;
                this.paymentError = '';
                const fd = new FormData();
                fd.append('_token', this.csrfToken);
                fd.append('course_detail_id', this.paymentForm.course_detail_id);
                fd.append('payment_mode', this.paymentForm.payment_mode);
                fd.append('start_date', this.paymentForm.start_date);
                fd.append('end_date', this.paymentForm.end_date);
                fd.append('remarks', this.paymentForm.remarks || '');
                try {
                    const res = await fetch(this.usersListBaseUrl + '/' + this.paymentUserId + '/orders', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                        credentials: 'same-origin',
                        body: fd,
                    });
                    const data = await res.json().catch(() => ({}));
                    if (res.status === 422) {
                        let msg = data.message || '';
                        if (data.errors) msg = Object.values(data.errors).flat().join(' ');
                        this.paymentError = msg || 'Validation failed.';
                        return;
                    }
                    if (! res.ok) {
                        this.paymentError = data.message || 'Could not save order.';
                        return;
                    }
                    window.location.reload();
                } catch (e) {
                    this.paymentError = 'Network error. Please try again.';
                } finally {
                    this.paymentSubmitting = false;
                }
            },
            displayValue(key, value) {
                if (value === undefined || value === null || value === '') return '—';
                if (key === 'active_status') return value ? 'Active' : 'Inactive';
                if (key === 'date_of_birth') {
                    const date = new Date(value);
                    if (!isNaN(date)) {
                        const day = String(date.getDate()).padStart(2, '0');
                        const month = String(date.getMonth() + 1).padStart(2, '0');
                        const year = date.getFullYear();
                        return `${day}-${month}-${year}`;
                    }
                }
                return value;
            },
        }));
    });
</script>
@endpush
