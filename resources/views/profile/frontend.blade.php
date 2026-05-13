@extends('layouts.frontend.app')

@section('title', 'My Profile')

@section('content')
    @php
        $inputClass = 'mt-1 block w-full rounded-lg border border-slate-300 px-3 py-2 text-sm text-slate-700 focus:border-logo-blue focus:outline-none focus:ring-2 focus:ring-logo-blue/20';
    @endphp
    <section class="mx-auto max-w-6xl px-4 pb-16 pt-32 sm:px-6 lg:px-8" x-data="{ tab: 'personal' }">
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between border-b border-slate-200 pb-5 text-sm font-semibold gap-8">
                <div class="flex flex-nowrap items-center gap-x-8 sm:gap-x-12 lg:gap-x-16 overflow-x-auto pb-2 sm:pb-0 scrollbar-hide">
                    <button type="button" @click="tab = 'personal'" :class="tab === 'personal' ? 'text-logo-blue border-logo-blue' : 'text-slate-500 border-transparent'" class="whitespace-nowrap border-b-2 pb-2 text-left transition">Personal Information</button>
                    <button type="button" @click="tab = 'academic'" :class="tab === 'academic' ? 'text-logo-blue border-logo-blue' : 'text-slate-500 border-transparent'" class="whitespace-nowrap border-b-2 pb-2 text-left transition">Academic Information</button>
                    <button type="button" @click="tab = 'professional'" :class="tab === 'professional' ? 'text-logo-blue border-logo-blue' : 'text-slate-500 border-transparent'" class="whitespace-nowrap border-b-2 pb-2 text-left transition">Professional Information</button>
                    <button type="button" @click="tab = 'course'" :class="tab === 'course' ? 'text-logo-blue border-logo-blue' : 'text-slate-500 border-transparent'" class="whitespace-nowrap border-b-2 pb-2 text-left transition">My Course</button>
                </div>
                <div class="w-40 rounded-lg bg-logo-blue py-1 text-center text-[13px] font-bold text-white shadow-sm">
                    UID: {{ auth()->user()->unique_sequence_number ?? 'N/A' }}
                </div>
            </div>

            <form x-show="tab === 'personal'" method="POST" action="{{ route('profile.update') }}" class="mt-6">
                @csrf
                @method('PATCH')
                <div class="grid gap-4 sm:grid-cols-2">
                    <label class="text-sm font-medium text-slate-700">Name<input name="name" value="{{ old('name', auth()->user()->name) }}" class="{{ $inputClass }} bg-slate-50 cursor-not-allowed" readonly /></label>
                    <label class="text-sm font-medium text-slate-700">Gender
                        <select name="gender" class="{{ $inputClass }}">
                            <option value="">Select</option>
                            <option value="male" @selected(old('gender', auth()->user()->gender) === 'male')>Male</option>
                            <option value="female" @selected(old('gender', auth()->user()->gender) === 'female')>Female</option>
                            <option value="other" @selected(old('gender', auth()->user()->gender) === 'other')>Other</option>
                        </select>
                    </label>
                    <label class="text-sm font-medium text-slate-700">Date of Birth<input type="date" name="date_of_birth" value="{{ old('date_of_birth', optional(auth()->user()->date_of_birth)->format('Y-m-d')) }}" class="{{ $inputClass }}" /></label>
                    <label class="text-sm font-medium text-slate-700">Aadhar Number<input name="aadhar_number" value="{{ old('aadhar_number', auth()->user()->aadhar_number) }}" class="{{ $inputClass }}" /></label>
                    <label class="text-sm font-medium text-slate-700">Mobile Number<input name="phone" value="{{ old('phone', auth()->user()->phone) }}" class="{{ $inputClass }}" /></label>
                    <label class="text-sm font-medium text-slate-700">Email ID (Username)<input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="{{ $inputClass }}" /></label>
                    <label class="text-sm font-medium text-slate-700">Residential Address<input name="address_line_1" value="{{ old('address_line_1', auth()->user()->address_line_1) }}" class="{{ $inputClass }}" /></label>
                    <label class="text-sm font-medium text-slate-700">City<input name="city" value="{{ old('city', auth()->user()->city) }}" class="{{ $inputClass }}" /></label>
                    <label class="text-sm font-medium text-slate-700">Pincode<input name="zip_code" value="{{ old('zip_code', auth()->user()->zip_code) }}" class="{{ $inputClass }}" /></label>
                    <label class="text-sm font-medium text-slate-700">District<input name="district" value="{{ old('district', auth()->user()->district) }}" class="{{ $inputClass }}" /></label>
                    <label class="text-sm font-medium text-slate-700">State<input name="state" value="{{ old('state', auth()->user()->state) }}" class="{{ $inputClass }}" /></label>
                </div>
                <button type="submit" class="mt-6 inline-flex rounded-full bg-logo-light-green px-6 py-2.5 text-sm font-semibold text-white transition hover:bg-green-600">
                    UPDATE INFORMATION
                </button>
            </form>

            <form x-show="tab === 'academic'" method="POST" action="{{ route('profile.update') }}" class="mt-6">
                @csrf
                @method('PATCH')
                <div class="grid gap-4 sm:grid-cols-2">
                    <label class="text-sm font-medium text-slate-700">Qualification<input name="qualification" value="{{ old('qualification', auth()->user()->qualification) }}" class="{{ $inputClass }}" /></label>
                    <label class="text-sm font-medium text-slate-700">Year of Completion<input name="completed_year" value="{{ old('completed_year', auth()->user()->completed_year) }}" class="{{ $inputClass }}" /></label>
                    <label class="text-sm font-medium text-slate-700">Name of the Institute<input name="institution_name" value="{{ old('institution_name', auth()->user()->institution_name) }}" class="{{ $inputClass }}" /></label>
                    <label class="text-sm font-medium text-slate-700">Name of the University/ Board<input name="university_board" value="{{ old('university_board', auth()->user()->university_board) }}" class="{{ $inputClass }}" /></label>
                    <label class="text-sm font-medium text-slate-700">RN<input name="rn_number" value="{{ old('rn_number', auth()->user()->rn_number) }}" class="{{ $inputClass }} bg-slate-50 cursor-not-allowed" readonly /></label>
                    <label class="text-sm font-medium text-slate-700">RM<input name="rm_number" value="{{ old('rm_number', auth()->user()->rm_number) }}" class="{{ $inputClass }}" /></label>
                    <label class="text-sm font-medium text-slate-700">RNM<input name="rnm_number" value="{{ old('rnm_number', auth()->user()->rnm_number) }}" class="{{ $inputClass }}" /></label>
                </div>
                <button type="submit" class="mt-6 inline-flex rounded-full bg-logo-light-green px-6 py-2.5 text-sm font-semibold text-white transition hover:bg-green-600">
                    UPDATE INFORMATION
                </button>
            </form>

            <form x-show="tab === 'professional'" method="POST" action="{{ route('profile.update') }}" class="mt-6">
                @csrf
                @method('PATCH')
                <div class="grid gap-4 sm:grid-cols-2">
                    <label class="text-sm font-medium text-slate-700">Designation<input name="designation" value="{{ old('designation', auth()->user()->designation) }}" class="{{ $inputClass }}" /></label>
                    <label class="text-sm font-medium text-slate-700">Type of Organization
                        <select name="organization_type" class="{{ $inputClass }}">
                            <option value="">Select</option>
                            <option value="Clincal" @selected(old('organization_type', auth()->user()->organization_type) === 'Clincal')>Clincal</option>
                            <option value="Public health" @selected(old('organization_type', auth()->user()->organization_type) === 'Public health')>Public health</option>
                            <option value="Teaching" @selected(old('organization_type', auth()->user()->organization_type) === 'Teaching')>Teaching</option>
                            <option value="Others" @selected(old('organization_type', auth()->user()->organization_type) === 'Others')>Others</option>
                        </select>
                    </label>
                    <label class="text-sm font-medium text-slate-700">Name of the Organization<input name="organization_name" value="{{ old('organization_name', auth()->user()->organization_name) }}" class="{{ $inputClass }}" /></label>
                    <label class="text-sm font-medium text-slate-700">Total Years of Experience<input name="total_years_experience" value="{{ old('total_years_experience', auth()->user()->total_years_experience) }}" class="{{ $inputClass }}" /></label>
                    <label class="text-sm font-medium text-slate-700">Organization Address<input name="professional_address_line_1" value="{{ old('professional_address_line_1', auth()->user()->professional_address_line_1) }}" class="{{ $inputClass }}" /></label>
                    <label class="text-sm font-medium text-slate-700">City<input name="professional_city" value="{{ old('professional_city', auth()->user()->professional_city) }}" class="{{ $inputClass }}" /></label>
                    <label class="text-sm font-medium text-slate-700">Pincode<input name="professional_zip_code" value="{{ old('professional_zip_code', auth()->user()->professional_zip_code) }}" class="{{ $inputClass }}" /></label>
                    <label class="text-sm font-medium text-slate-700">District<input name="professional_district" value="{{ old('professional_district', auth()->user()->professional_district) }}" class="{{ $inputClass }}" /></label>
                    <label class="text-sm font-medium text-slate-700">State<input name="professional_state" value="{{ old('professional_state', auth()->user()->professional_state) }}" class="{{ $inputClass }}" /></label>
                </div>
                <button type="submit" class="mt-6 inline-flex rounded-full bg-logo-light-green px-6 py-2.5 text-sm font-semibold text-white transition hover:bg-green-600">
                    UPDATE INFORMATION
                </button>
            </form>

            <div x-show="tab === 'course'" class="mt-6">
                <h3 class="text-xl font-semibold text-slate-900">CPD Module</h3>
                <div class="mt-3 overflow-hidden rounded-xl border border-slate-200">
                    <table class="w-full border-collapse text-sm">
                        <thead class="bg-logo-blue text-white">
                            <tr>
                                <th class="px-3 py-2 text-left">#</th>
                                <th class="px-3 py-2 text-left">Name of Module</th>
                                <th class="px-3 py-2 text-left">Date of Purchase</th>
                                <th class="px-3 py-2 text-left">Date of Expiry</th>
                                <th class="px-3 py-2 text-left">Date of Completion</th>
                                <th class="px-3 py-2 text-left">Certificate</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse (($purchasedCourses ?? collect()) as $courseOrder)
                                <tr class="border-t border-slate-200">
                                    <td class="px-3 py-3 text-slate-700">{{ $loop->iteration }}</td>
                                    <td class="px-3 py-3 text-slate-700">{{ $courseOrder->courseDetail?->couse_name ?? 'N/A' }}</td>
                                    <td class="px-3 py-3 text-slate-700">{{ optional($courseOrder->start_date)->format('d-m-Y') ?? '-' }}</td>
                                    <td class="px-3 py-3 text-slate-700">{{ optional($courseOrder->end_date)->format('d-m-Y') ?? '-' }}</td>
                                    <td class="px-3 py-3 text-slate-700">{{ $courseOrder->completion ? $courseOrder->completion->completed_at->format('d-m-Y') : '-' }}</td>
                                    <td class="px-3 py-3 text-slate-700">
                                        @if($courseOrder->completion && $courseOrder->completion->passed)
                                            @php
                                                $u = auth()->user();
                                                $userName = $u->name ?: ($u->first_name . ' ' . $u->last_name);
                                                $rnNumber = $u->rn_number ?? 'N/A';
                                                $userId = $u->unique_sequence_number ?? 'N/A';
                                                $courseName = $courseOrder->courseDetail?->couse_name ?? 'N/A';
                                                $qrData = "User ID: " . $userId . "\nName: " . $userName . "\nRN #: " . $rnNumber . "\nCourse: " . $courseName;
                                                $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=50x50&data=" . urlencode($qrData);
                                            @endphp
                                            <div class="flex items-center gap-3">
                                                {{-- <div class="group relative">
                                                    <img src="{{ $qrUrl }}" alt="QR" class="h-8 w-8 rounded border border-slate-200 shadow-sm transition hover:scale-150 bg-white">
                                                    <div class="absolute bottom-full left-1/2 mb-2 hidden -translate-x-1/2 rounded-lg bg-slate-900 px-2 py-1 text-[10px] text-white group-hover:block whitespace-nowrap">
                                                        Scan to verify
                                                    </div>
                                                </div> --}}
                                                <a href="{{ route('certificates.download', $courseOrder->id) }}" 
                                                   class="inline-flex items-center gap-1.5 rounded-full bg-logo-blue px-4 py-1.5 text-xs font-semibold text-white shadow-sm transition hover:bg-blue-700 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-logo-blue/50">
                                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                                    </svg>
                                                    <span>Download</span>
                                                </a>
                                            </div>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-3 py-4 text-slate-500">No modules available yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
