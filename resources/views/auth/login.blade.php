<x-guest-layout>

    <main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-10 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">



                        <div class="card" style="max-width: 2160px; max-height: 600px;">
                            <div class="row g-0">

                                <div class="col-md-7">
                                    <img src="{{ asset('admin_asset/img/photos/image.png')}}" class="img-fluid rounded-start" style="max-height:600px" >
                                </div>

                                <div class="col-md-5 py-3 px-2">
                                    <div class="card-body">

                                        <div class="text-center mt-4">
                                            <img src="{{ asset('admin_asset/img/logo/continental_logo.png') }}" class="img-fluid" style="width: 200px">
                                            <h1 class="h1 mt-4">Welcome Back!</h1>
                                            <p class="text-secondary pb-2"> Sign in to your account to continue.</p>
                                        </div>

                                        <div class="m-sm-3">
                                            <form action="{{ route('login') }}" method="post">
                                                @csrf

                                                <div class="mb-3">
                                                    <label class="form-label" for="username">Username</label>
                                                    <input class="form-control form-control-lg" type="username" name="username" placeholder="Enter your username" value="{{ old('username')}}"/>
                                                    <x-error field="username" />
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Password</label>
                                                    <input class="form-control form-control-lg" type="password" name="password" placeholder="Enter your password" />
                                                    <x-error field="password" />
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="form-check align-items-center">
                                                        <input id="customControlInline" type="checkbox" class="form-check-input" value="remember-me" name="remember-me">
                                                        <label class="form-check-label text-sm text-secondary" for="customControlInline">Remember me</label>
                                                    </div>
                                                    <a href="" class="text-sm">Forget your password?</a>
                                                </div>
                                                <div class="d-grid gap-2 mt-3">
                                                    <input type="submit" class="btn btn-lg btn-primary" value="Sing in">
                                                </div>

                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</main>

</x-guest-layout>>
