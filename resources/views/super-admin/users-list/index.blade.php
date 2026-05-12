@extends('layouts.app')

@section('content')
    <livewire:super-admin.users-list.index />
@endsection

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('usersList', (usersListBaseUrl, csrfToken) => ({
            usersListBaseUrl,
            csrfToken,
            detailOpen: false,
            detailUser: null,
            paymentOpen: false,
            paymentUserId: null,
            courseOpen: false,
            courseUserId: null,
            courseOrders: [],
            courseLoading: false,
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
                this.detailOpen = true;
                document.body.style.overflow = 'hidden';
            },
            closeDetail() {
                this.detailOpen = false;
                this.detailUser = null;
                if (! this.paymentOpen && ! this.courseOpen) document.body.style.overflow = 'unset';
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
                if (! this.detailOpen && ! this.paymentOpen) document.body.style.overflow = 'unset';
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
                return value;
            },
        }));
    });
</script>
@endpush
