<!--begin::sidebar menu-->
<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
	<!--begin::Menu wrapper-->
	<div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
		<!--begin::Menu-->
		<div class="menu menu-column menu-rounded menu-sub-indention px-3 fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
			<!--begin:Menu item-->
            <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                    <span class="menu-icon">{!! getIcon('element-11', 'fs-2') !!}</span>
                    <span class="fw-semibold">Beranda</span>
                </a>
                <!--end:Menu link-->
            </div>
			<!--begin:Menu item-->
			<div class="menu-item pt-5">
				<!--begin:Menu content-->
				<div class="menu-content">
					<span class="menu-heading fw-bold text-uppercase fs-7">MENU</span>
				</div>
				<!--end:Menu content-->
			</div>
			<!--end:Menu item-->
            <!--begin:Menu item-->
            @hasrole('administrator')
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ request()->routeIs('setting-management.*') ? 'here show' : '' }}">
                <!--begin:Menu link-->
                <span class="menu-link">
					<span class="menu-icon">{!! getIcon('setting-2', 'fs-2') !!}</span>
					<span class="fw-semibold menu-title">Setting</span>
					<span class="menu-arrow"></span>
				</span>
                <!--end:Menu link-->
                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-accordion">
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->routeIs(['setting-management.institution', 'setting-management.institution.*']) ? 'active' : '' }}" href="{{ route('setting-management.institution') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
                            <span class="menu-title">Instansi</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->routeIs(['setting-management.period', 'setting-management.period.*']) ? 'active' : '' }}" href="{{ route('setting-management.period') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
                            <span class="menu-title">Tahun Periode</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->routeIs(['setting-management.hijri', 'setting-management.hijri.*']) ? 'active' : '' }}" href="{{ route('setting-management.hijri') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
                            <span class="menu-title">Kalender Hijri</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->routeIs(['setting-management.asset', 'setting-management.asset.*']) ? 'active' : '' }}" href="{{ route('setting-management.asset') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
                            <span class="menu-title">Aset Atribut</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                </div>
                <!--end:Menu sub-->
            </div>
            <!--end:Menu item-->
			<!--begin:Menu item-->
			<div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ request()->routeIs('user-management.*') ? 'here show' : '' }}">
				<!--begin:Menu link-->
				<span class="menu-link">
					<span class="menu-icon">{!! getIcon('user-edit', 'fs-2') !!}</span>
					<span class="fw-semibold menu-title">User</span>
					<span class="menu-arrow"></span>
				</span>
				<!--end:Menu link-->
				<!--begin:Menu sub-->
				<div class="menu-sub menu-sub-accordion">
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->routeIs(['user-management.permission', 'user-management.permission.*']) ? 'active' : '' }}" href="{{ route('user-management.permission') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
                            <span class="menu-title">Permission</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
					<!--begin:Menu item-->
					<div class="menu-item">
						<!--begin:Menu link-->
						<a class="menu-link {{ request()->routeIs(['user-management.role', 'user-management.role.*']) ? 'active' : '' }}" href="{{ route('user-management.role') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title">Role</span>
						</a>
						<!--end:Menu link-->
					</div>
					<!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->routeIs(['user-management.user', 'user-management.user.*']) ? 'active' : '' }}" href="{{ route('user-management.user') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
                            <span class="menu-title">User</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
				</div>
				<!--end:Menu sub-->
			</div>
            @endhasrole
            <!--end:Menu item-->
            <!--begin:Menu item-->
            @hasrole('staff-secretary|staff-treasurer')
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ request()->routeIs('register-management.*') ? 'here show' : '' }}">
                <!--begin:Menu link-->
                <span class="menu-link">
					<span class="menu-icon">{!! getIcon('book-open', 'fs-2') !!}</span>
					<span class="fw-semibold menu-title">Registrasi</span>
					<span class="menu-arrow"></span>
				</span>
                <!--end:Menu link-->
                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-accordion">
                    @can('create register management')
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->routeIs(['register-management.guardian', 'register-management.guardian.*']) ? 'active' : '' }}" href="{{ route('register-management.guardian') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
                            <span class="menu-title">Registrasi Wali</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->routeIs(['register-management.student', 'register-management.student.*']) ? 'active' : '' }}" href="{{ route('register-management.student') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
                            <span class="menu-title">Registrasi Santri</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    @endcan
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->routeIs(['register-management.domicile', 'register-management.domicile.*']) ? 'active' : '' }}" href="{{ route('register-management.domicile') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
                            <span class="menu-title">Registrasi Domisili</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->routeIs(['register-management.diniyah', 'register-management.diniyah.*']) ? 'active' : '' }}" href="{{ route('register-management.diniyah') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
                            <span class="menu-title">Registrasi Diniyah</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->routeIs(['register-management.formal', 'register-management.formal.*']) ? 'active' : '' }}" href="{{ route('register-management.formal') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
                            <span class="menu-title">Registrasi Formal</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    @can('read register management')
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->routeIs(['register-management.status', 'register-management.status.*']) ? 'active' : '' }}" href="{{ route('register-management.status') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
                            <span class="menu-title">Registrasi Status</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    @endcan
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->routeIs(['register-management.registration', 'register-management.registration.*']) ? 'active' : '' }}" href="{{ route('register-management.registration') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
                            <span class="menu-title">Data Registrasi</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                </div>
                <!--end:Menu sub-->
            </div>
            @endhasrole
            <!--end:Menu item-->
            <!--begin:Menu item-->
            @hasrole('staff-secretary')
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ request()->routeIs('licensing-management.*') ? 'here show' : '' }}">
                <!--begin:Menu link-->
                <span class="menu-link">
					<span class="menu-icon">{!! getIcon('tablet-ok', 'fs-2') !!}</span>
					<span class="fw-semibold menu-title">Perizinan</span>
					<span class="menu-arrow"></span>
				</span>
                <!--end:Menu link-->
                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-accordion">
                    @can('create register management')
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {{ request()->routeIs(['licensing-management.configuration', 'licensing-management.configuration.*']) ? 'active' : '' }}" href="{{ route('licensing-management.configuration') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
                                <span class="menu-title">Pengaturan</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {{ request()->routeIs(['licensing-management.petition', 'licensing-management.petition.*']) ? 'active' : '' }}" href="{{ route('licensing-management.petition') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
                                <span class="menu-title">Permohonan</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {{ request()->routeIs(['licensing-management.license', 'licensing-management.license.*']) ? 'active' : '' }}" href="{{ route('licensing-management.license') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
                                <span class="menu-title">Surat Izin</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {{ request()->routeIs(['licensing-management.comeback', 'licensing-management.comeback.*']) ? 'active' : '' }}" href="{{ route('licensing-management.comeback') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
                                <span class="menu-title">Kembali</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {{ request()->routeIs(['licensing-management.recapitulation', 'licensing-management.recapitulation.*']) ? 'active' : '' }}" href="{{ route('licensing-management.recapitulation') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
                                <span class="menu-title">Rekapitulasi</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                    @endcan
                </div>
                <!--end:Menu sub-->
            </div>
            @endhasrole
            <!--end:Menu item-->
            <!--begin:Menu item-->
            @hasanyrole('treasurer|staff-treasurer')
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ request()->routeIs('payment-management.*') ? 'here show' : '' }}">
                <!--begin:Menu link-->
                <span class="menu-link">
					<span class="menu-icon">{!! getIcon('finance-calculator', 'fs-2') !!}</span>
					<span class="fw-semibold menu-title">Pembayaran</span>
					<span class="menu-arrow"></span>
				</span>
                <!--end:Menu link-->
                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-accordion">
                    <!--begin:Menu item-->
                    @can('create payment management')
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->routeIs(['payment-management.account', 'payment-management.account.*']) ? 'active' : '' }}" href="{{ route('payment-management.account') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
                            <span class="menu-title">Akun</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    @endcan
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    @can('create payment management')
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->routeIs(['payment-management.disbursement', 'payment-management.disbursement.*']) ? 'active' : '' }}" href="{{ route('payment-management.disbursement') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
                            <span class="menu-title">Distribusi Akun</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    @endcan
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    @can('create payment management')
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->routeIs(['payment-management.registration', 'payment-management.registration.*']) ? 'active' : '' }}" href="{{ route('payment-management.registration') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
                            <span class="menu-title">Tarif Pangkal Masuk</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    @endcan
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    @can('create payment management')
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->routeIs(['payment-management.infaq', 'payment-management.infaq.*']) ? 'active' : '' }}" href="{{ route('payment-management.infaq') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
                            <span class="menu-title">Tarif Infaq</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    @endcan
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    @can('create payment management')
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->routeIs(['payment-management.pesantren', 'payment-management.pesantren.*']) ? 'active' : '' }}" href="{{ route('payment-management.pesantren') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
                            <span class="menu-title">Tarif Pesantren</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    @endcan
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    @can('create payment management')
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->routeIs(['payment-management.tahfidz', 'payment-management.tahfidz.*']) ? 'active' : '' }}" href="{{ route('payment-management.tahfidz') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
                            <span class="menu-title">Tarif Tahfidz</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    @endcan
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    @can('create payment management')
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->routeIs(['payment-management.school', 'payment-management.school.*']) ? 'active' : '' }}" href="{{ route('payment-management.school') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
                            <span class="menu-title">Tarif Madrasah</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    @endcan
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    @can('read payment management')
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->routeIs(['payment-management.fare', 'payment-management.fare.*']) ? 'active' : '' }}" href="{{ route('payment-management.fare') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
                            <span class="menu-title">Atur Tarif</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->routeIs(['payment-management.reduction', 'payment-management.reduction.*']) ? 'active' : '' }}" href="{{ route('payment-management.reduction') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                            <span class="menu-title">Pengurangan</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {{ request()->routeIs(['payment-management.distribution', 'payment-management.distribution.*']) ? 'active' : '' }}" href="{{ route('payment-management.distribution') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                                <span class="menu-title">Distribusi</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->routeIs(['payment-management.payment', 'payment-management.payment.*']) ? 'active' : '' }}" href="{{ route('payment-management.payment') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
                            <span class="menu-title">Pembayaran</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->routeIs(['payment-management.recapitulation', 'payment-management.recapitulation.*']) ? 'active' : '' }}" href="{{ route('payment-management.recapitulation') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                            <span class="menu-title">Rekapitulasi</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    @endcan
                    <!--end:Menu item-->
                </div>
                <!--end:Menu sub-->
            </div>
            @endhasanyrole
            <!--end:Menu item-->
			<!--begin:Menu item-->
			<div class="menu-item pt-5">
				<!--begin:Menu content-->
				<div class="menu-content">
					<span class="menu-heading fw-bold text-uppercase fs-7">UTILITY</span>
				</div>
				<!--end:Menu content-->
			</div>
			<!--end:Menu item-->
            <!--begin:Menu item-->
            <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link {{ request()->routeIs('account') ? 'active' : '' }}" href="{{ route('account') }}">
                    <span class="menu-icon">{!! getIcon('profile-circle', 'fs-2') !!}</span>
                    <span class="fw-semibold">Profil Akun</span>
                </a>
                <!--end:Menu link-->
            </div>
            <!--end:Menu item-->
			<!--begin:Menu item-->
            <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                    <span class="menu-icon">{!! getIcon('information-4', 'fs-2') !!}</span>
                    <span class="fw-semibold">Tentang</span>
                </a>
                <!--end:Menu link-->
            </div>
			<!--end:Menu item-->
		</div>
		<!--end::Menu-->
	</div>
	<!--end::Menu wrapper-->
</div>
<!--end::sidebar menu-->
