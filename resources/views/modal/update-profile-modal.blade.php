<div class="modal fade" id="updateProfileModal" tabindex="-1" aria-labelledby="updateProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateProfileModalLabel">{{ __('Profile Information') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('profile.updateModal') }}">
                    @csrf
                    @method('patch')
    
                    <!-- form fields are here -->
                        <!-- Name Field -->
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name ?? '') }}" required autofocus autocomplete="name">
                        @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                    </div>

                    <!-- Email Field -->
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email ?? '') }}" required autocomplete="username">
                        @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                    </div>

                    <!-- Phone Number Field -->
                    <div class="mb-3">
                        <label for="phone_number" class="form-label">{{ __('Phone Number') }}</label>
                        <input type="text" id="phone_number" name="phone_number" class="form-control" value="{{ old('phone_number', $user->phone_number ?? '') }}" autocomplete="phone_number">
                        @error('phone_number')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                    </div>

                    <!-- Address Field -->
                    <div class="mb-3">
                        <label for="alamat" class="form-label">{{ __('Address') }}</label>
                        <input type="text" id="alamat" name="alamat" class="form-control" value="{{ old('alamat', $user->alamat ?? '') }}" autocomplete="alamat">
                        @error('alamat')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Save changes') }}</button>
                    </div>

                </form>
            </div>
           
        </div>
    </div>
</div>
