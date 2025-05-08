<x-guest-layout>

    <main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">Welcome to TBMS!</h1>
							<p class="lead">
								Sign in to your account to continue
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-3">
                                    <form action="/login" method="post">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label" for="username">Username</label>
                                            <input class="form-control form-control-lg" type="username" name="username" placeholder="Enter your username" value="{{ old('username')}}"/>
                                            @error('username')
                                                <p class="text-danger text-sm">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <input class="form-control form-control-lg" type="password" name="password" placeholder="Enter your password" />
                                            @error('password')
                                                <p class="text-danger text-sm">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="d-grid gap-2 mt-5">
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
	</main>

</x-guest-layout>>
