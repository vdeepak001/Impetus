@extends('layouts.frontend.app')

@section('title', 'My Profile')

@section('content')
    @php
        $inputClass = 'mt-1 block w-full rounded-lg border border-slate-300 px-3 py-2 text-sm text-slate-700 focus:border-logo-blue focus:outline-none focus:ring-2 focus:ring-logo-blue/20';
    @endphp
    <section class="mx-auto max-w-6xl px-4 pb-16 pt-32 sm:px-6 lg:px-8" x-data="{ tab: 'personal' }">
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
            <div class="grid grid-cols-2 gap-3 border-b border-slate-200 pb-5 text-sm font-semibold sm:grid-cols-4">
                <button type="button" @click="tab = 'personal'" :class="tab === 'personal' ? 'text-logo-blue border-logo-blue' : 'text-slate-500 border-transparent'" class="border-b-2 pb-2 text-left transition">Personal Information</button>
                <button type="button" @click="tab = 'academic'" :class="tab === 'academic' ? 'text-logo-blue border-logo-blue' : 'text-slate-500 border-transparent'" class="border-b-2 pb-2 text-left transition">Academic Information</button>
                <button type="button" @click="tab = 'professional'" :class="tab === 'professional' ? 'text-logo-blue border-logo-blue' : 'text-slate-500 border-transparent'" class="border-b-2 pb-2 text-left transition">Professional Information</button>
                <button type="button" @click="tab = 'course'" :class="tab === 'course' ? 'text-logo-blue border-logo-blue' : 'text-slate-500 border-transparent'" class="border-b-2 pb-2 text-left transition">My Course</button>
            </div>

            <form x-show="tab === 'personal'" method="POST" action="{{ route('profile.update') }}" class="mt-6">
                @csrf
                @method('PATCH')
                <div class="grid gap-4 sm:grid-cols-2">
                    <label class="text-sm font-medium text-slate-700">Name<input name="name" value="{{ old('name', auth()->user()->name) }}" class="{{ $inputClass }}" /></label>
                    <label class="text-sm font-medium text-slate-700">Email-ID (Username)<input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="{{ $inputClass }}" /></label>
                    <label class="text-sm font-medium text-slate-700">Mobile No<input name="phone" value="{{ old('phone', auth()->user()->phone) }}" class="{{ $inputClass }}" /></label>
                    <label class="text-sm font-medium text-slate-700">PAN Number<input name="pan_number" value="{{ old('pan_number', auth()->user()->pan_number) }}" class="{{ $inputClass }}" /></label>
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
                    <label class="text-sm font-medium text-slate-700">Address Line 1<input name="address_line_1" value="{{ old('address_line_1', auth()->user()->address_line_1) }}" class="{{ $inputClass }}" /></label>
                    <label class="text-sm font-medium text-slate-700">Address Line 2<input name="address_line_2" value="{{ old('address_line_2', auth()->user()->address_line_2) }}" class="{{ $inputClass }}" /></label>
                    <label class="text-sm font-medium text-slate-700">City<input name="city" value="{{ old('city', auth()->user()->city) }}" class="{{ $inputClass }}" /></label>
                    <label class="text-sm font-medium text-slate-700">District<input name="district" value="{{ old('district', auth()->user()->district) }}" class="{{ $inputClass }}" /></label>
                    <label class="text-sm font-medium text-slate-700">State<input name="state" value="{{ old('state', auth()->user()->state) }}" class="{{ $inputClass }}" /></label>
                    <label class="text-sm font-medium text-slate-700">Pincode<input name="zip_code" value="{{ old('zip_code', auth()->user()->zip_code) }}" class="{{ $inputClass }}" /></label>
                </div>
                <button type="submit" class="mt-6 inline-flex rounded-full bg-logo-light-green px-6 py-2.5 text-sm font-semibold text-white transition hover:bg-green-600">
                    UPDATE INFORMATION
                </button>
            </form>

            <form x-show="tab === 'academic'" method="POST" action="{{ route('profile.update') }}" class="mt-6">
                @csrf
                @method('PATCH')
                <div class="grid gap-4 sm:grid-cols-2">
                    <label class="text-sm font-medium text-slate-700">RN Number<input name="rn_number" value="{{ old('rn_number', auth()->user()->rn_number) }}" class="{{ $inputClass }}" /></label>
                    <label class="text-sm font-medium text-slate-700">RM Number<input name="rm_number" value="{{ old('rm_number', auth()->user()->rm_number) }}" class="{{ $inputClass }}" /></label>
                    <label class="text-sm font-medium text-slate-700">Qualification<input name="qualification" value="{{ old('qualification', auth()->user()->qualification) }}" class="{{ $inputClass }}" /></label>
                    <label class="text-sm font-medium text-slate-700">GNM Details (State Council)<input name="academic_state" value="{{ old('academic_state', auth()->user()->academic_state) }}" class="{{ $inputClass }}" /></label>
                    <label class="text-sm font-medium text-slate-700">Name of Institution<input name="institution_name" value="{{ old('institution_name', auth()->user()->institution_name) }}" class="{{ $inputClass }}" /></label>
                    <label class="text-sm font-medium text-slate-700">Completed Year<input name="completed_year" value="{{ old('completed_year', auth()->user()->completed_year) }}" class="{{ $inputClass }}" /></label>
                </div>
                <button type="submit" class="mt-6 inline-flex rounded-full bg-logo-light-green px-6 py-2.5 text-sm font-semibold text-white transition hover:bg-green-600">
                    UPDATE INFORMATION
                </button>
            </form>

            <form x-show="tab === 'professional'" method="POST" action="{{ route('profile.update') }}" class="mt-6">
                @csrf
                @method('PATCH')
                <div class="grid gap-4 sm:grid-cols-2">
                    <label class="text-sm font-medium text-slate-700">Total Years of Experience<input name="total_years_experience" value="{{ old('total_years_experience', auth()->user()->total_years_experience) }}" class="{{ $inputClass }}" /></label>
                    <label class="text-sm font-medium text-slate-700">Name of Organization<input name="organization_name" value="{{ old('organization_name', auth()->user()->organization_name) }}" class="{{ $inputClass }}" /></label>
                    <label class="text-sm font-medium text-slate-700">Type of Organization<input name="organization_type" value="{{ old('organization_type', auth()->user()->organization_type) }}" class="{{ $inputClass }}" /></label>
                    <label class="text-sm font-medium text-slate-700">Department<input name="department_name" value="{{ old('department_name', auth()->user()->department_name) }}" class="{{ $inputClass }}" /></label>
                    <label class="text-sm font-medium text-slate-700">Designation<input name="designation" value="{{ old('designation', auth()->user()->designation) }}" class="{{ $inputClass }}" /></label>
                    <label class="text-sm font-medium text-slate-700">Address Line 1<input name="professional_address_line_1" value="{{ old('professional_address_line_1', auth()->user()->professional_address_line_1) }}" class="{{ $inputClass }}" /></label>
                    <label class="text-sm font-medium text-slate-700">Address Line 2<input name="professional_address_line_2" value="{{ old('professional_address_line_2', auth()->user()->professional_address_line_2) }}" class="{{ $inputClass }}" /></label>
                    <label class="text-sm font-medium text-slate-700">City<input name="professional_city" value="{{ old('professional_city', auth()->user()->professional_city) }}" class="{{ $inputClass }}" /></label>
                    <label class="text-sm font-medium text-slate-700">District<input name="professional_district" value="{{ old('professional_district', auth()->user()->professional_district) }}" class="{{ $inputClass }}" /></label>
                    <label class="text-sm font-medium text-slate-700">State<input name="professional_state" value="{{ old('professional_state', auth()->user()->professional_state) }}" class="{{ $inputClass }}" /></label>
                </div>
                <button type="submit" class="mt-6 inline-flex rounded-full bg-logo-light-green px-6 py-2.5 text-sm font-semibold text-white transition hover:bg-green-600">
                    UPDATE INFORMATION
                </button>
            </form>

            <div x-show="tab === 'course'" class="mt-6">
                <h3 class="text-xl font-semibold text-slate-900">Knowledge Based Module</h3>
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
                            <tr>
                                <td colspan="6" class="px-3 py-4 text-slate-500">No modules available yet.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
