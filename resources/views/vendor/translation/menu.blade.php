<div class="main-menu">
    <ul id="side-main-menu" class="side-menu list-unstyled">
        @if (auth()->user()->role_users_id == \App\User::CLIENT)
            <li class="mb-15 "><a href="{{ url('/client/dashboard') }}"> <i
                        class="dripicons-meter"></i><span>{{ __('Dashboard') }}</span></a></li>
            <li class="no-href color-green"><span>{{ __('STOOV') }}</span></li>
            <li><a href="{{ route('client-get-verletvergoeding') }}"><span> <i
                            class="dripicons-mail"></i>{{ __('Verletvergoeding') }}</span></a></li>
            <li><a href="{{ route('get-contact-training-grant') }}"><span> <i
                            class="dripicons-mail"></i>{{ __('Opleidingsvergoeding') }}</span></a></li>
            @if(!checkSubmitLoomsom())
            <li><a href="{{ route('client-get-loonsomopgave') }}"><span> <i
                            class="dripicons-mail"></i>{{ __('Loonsomopgave') }}</span></a></li>
            @endif
            <li class="mb-15 {{ request()->is('ingezonden_formulieren*') ? 'active' : '' }}">
                <a href="{{ route('course.index') }}"> <i
                        class="dripicons-mail"></i><span>{{ __('Aanvragen') }}</span>
                </a>
            </li>
            {{-- <li class="{{ request()->is('client/gegevens-wijzigens/*') ? 'active' : '' }}">
                <a href="{{ route('client.gegevens-wijzigens.index') }}"> <i
                        class="dripicons-user"></i><span>{{ __('Gegevens wijzigens') }}</span></a>
            </li> --}}
            @if (checkShowVakcertificaten())
                <li class="no-href color-green">
                    <span>{{ __('VAKCERTIFICATEN') }}</span>
                </li>
            @endif
            <li class="no-href color-green"><span>{{ __('KEURMERK') }}</span></li>
            <li class="{{ request()->is('staff*') ? 'active' : '' }}">
                <a href="{{ route('employees.index') }}"> <i
                        class="dripicons-user-group"></i><span>{{ __('Medewerkers') }}</span></a>
            </li>
        @else
            @if (auth()->user()->role_users_id == \App\User::ADMINISTRATOR)
                <li class="{{ request()->is('admin/dashboard*') ? 'active' : '' }}"><a
                        href="{{ url('/admin/dashboard') }}"> <i
                            class="dripicons-meter"></i><span>{{ __('Dashboard') }}</span></a>
                </li>
                <li class="no-href color-green"><span>{{ __('STOOV') }}</span></li>
            @endif
            <li class="{{ request()->is('ingezonden_formulieren*') ? 'active' : '' }}">
                <a href="{{ route('course.index') }}"> <i
                        class="dripicons-suitcase"></i><span>{{ __('Aanvragen') }}</span>
                </a>
            </li>
            <li class="{{ request()->is('loonsomopgaves*') ? 'active' : '' }}">
                <a href="{{ route('loonsomopgaves') }}"> <i
                        class="dripicons-suitcase"></i><span>{{ __('Loonsomopgaves') }}</span>
                </a>
            </li>
            <li class="{{ request()->is('beschikbare-budgetten*') ? 'active' : '' }}">
                <a href="{{ route('beschikbare-budgetten') }}"> <i
                        class="dripicons-jewel"></i><span>{{ __('Beschikbare budgetten') }}</span>
                </a>
            </li>
            <br />
            <li class="no-href color-green"><span>{{ __('VAKCERTIFICATEN') }}</span></li>
            <li class="{{ request()->is('organization*') ? 'active' : '' }}"><a href="{{ route('companies.index') }}">
                    <i class="dripicons-view-thumb"></i><span>{{ __('Organisatie') }}</span></a>
            </li>
            <li class="has-dropdown {{ request()->is('staff*') ? 'active' : '' }}">
                <a href="#employees" aria-expanded="false" data-toggle="collapse"> <i
                        class="dripicons-user-group"></i><span>{{ __('Medewerkers') }}</span></a>
                <ul id="employees" class="collapse list-unstyled ">
                    <li id="employee_list"><a href="{{ route('employees.index') }}">{{ __('Employee Lists') }}</a>
                    </li>
                    <li id="user-import"><a href="{{ route('employees.import') }}">{{ __('Import Employees') }}</a>
                    </li>
                    <li id="user-import"><a
                            href="{{ route('certificationImport') }}">{{ __('Certificering Importeren') }}</a>
                    </li>
                </ul>
            </li>
            <br/>
            <li
                class="has-dropdown @if (request()->is('user*')) {{ request()->is('user*') ? 'active' : '' }}@elseif(request()->is('add-user*')){{ request()->is('add-user*') ? 'active' : '' }} @endif">
                <a href="#users" aria-expanded="false" data-toggle="collapse">
                    <i class="dripicons-user"></i>
                    <span>{{ __('User') }}</span>
                </a>
                <ul id="users" class="collapse list-unstyled ">
                    <li id="users-menu"><a href="{{ route('users-list') }}">{{ __('Users List') }}</a></li>
                    <li id="user-roles"><a href={{ route('user-roles') }}>{{ __('Assign Role') }}</a></li>
                    <li id="user-last-login"><a href="{{ route('login-info') }}">{{ __('Users Last Login') }}</a>
                    </li>
                </ul>
            </li>
            <li class="has-dropdown {{ request()->is('settings*') ? 'active' : '' }}">
                @if (auth()->user()->can('view-role') ||
                        auth()->user()->can('view-general-setting') ||
                        auth()->user()->can('access-language') ||
                        auth()->user()->can('access-variable_type') ||
                        auth()->user()->can('access-variable_method') ||
                        auth()->user()->can('view-general-setting'))
                    <a href="#Customize_settings" aria-expanded="false" data-toggle="collapse">
                        <i class="dripicons-toggles"></i><span>{{ __('Customize Setting') }}</span>
                    </a>
                @endif
                <ul id="Customize_settings" class="collapse list-unstyled ">
                    <li id="roles"><a href="{{ route('roles.index') }}">{{ __('Roles and Access') }}</a></li>
                    <li id="general_settings"><a
                            href="{{ route('general_settings.index') }}">{{ __('General Settings') }}</a>
                    </li>

                    <li id="mail_setting"><a href="{{ route('setting.mail') }}">{{ __('Mail Setting') }}</a>
                    </li>

                    <li id="language_switch"><a
                            href="{{ route('languages.translations.index', 'English') }}">{{ __('Language Settings') }}</a>
                    </li>

                    <li id="variable_type"><a href="{{ route('variables.index') }}">{{ __('Variable Type') }}</a>
                    </li>
                    <li id="variable_method"><a
                            href="{{ route('variables_method.index') }}">{{ __('Variable Method') }}</a>
                    </li>
                    <li id="ip_setting"><a href="{{ route('ip_setting.index') }}">{{ __('IP Settings') }}</a></li>
                </ul>
            </li>
            <li class="has-dropdown {{ request()->is('file_manager*') ? 'active' : '' }}">

                <a href="#file_manager" aria-expanded="false" data-toggle="collapse"> <i
                        class="dripicons-archive"></i><span>{{ __('File Manager') }}</span>
                </a>

                <ul id="file_manager" class="collapse list-unstyled ">

                    <li id="files"><a href="{{ route('files.index') }}">{{ __('File Manager') }}</a>
                    </li>

                    <li id="official_documents"><a
                            href="{{ route('official_documents.index') }}">{{ __('Official Documents') }}</a>
                    </li>

                    <li id="file_config"><a href="{{ route('file_config.index') }}">{{ __('File Configuration') }}</a>
                    </li>
                </ul>
            </li>
            @if (auth()->user()->role_users_id == \App\User::ADMINISTRATOR)
                <li class="has-dropdown {{ request()->is('importeren*') ? 'active' : '' }}">
                    <a href="#importeren" aria-expanded="false" data-toggle="collapse"> <i
                            class="dripicons-browser-upload"></i><span>{{ __('Importeren') }}</span>
                    </a>
                    <ul id="importeren" class="collapse list-unstyled importeren">
                        <li class="#">
                            <a href="{{ route('course.verletvergoeding-importeren') }}">{{ __('Verletvergoeding importeren') }}</span>
                            </a>
                        </li>
                        <li class="#">
                            <a href="{{ route('course.opleidingsvergoeding-importeren') }}">{{ __('Opleidingsvergoeding importeren') }}</span>
                            </a>
                        </li>
                        <li class="#">
                            <a href="{{ route('course.loonsomopgave-importeren') }}">{{ __('Loonsomopgave importeren') }}</span>
                            </a>
                        </li>
                        <li class="#">
                            <a href="{{ route('budgets.importeren') }}">{{ __('Budgetten importeren') }}</span>
                            </a>
                        </li>
                        <li class="#">
                            <a href="{{ route('klanten.importeren') }}">{{ __('Klanten importeren') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            <li class="{{ request()->is('verzoek_loonsomopgave*') ? 'active' : '' }}">
                <a href="{{ route('course.course-request') }}"> <i
                        class="dripicons-mail"></i><span>{{ __('Verzoek loonsomopgave') }}</span>
                </a>
            </li>
            @if (auth()->user()->role_users_id == \App\User::ADMINISTRATOR)
                <li class="{{ request()->is('cursus-workshop*') ? 'active' : '' }}">
                    <a href="{{ route('naam_cursus.index') }}"> <i
                            class="dripicons-graduation"></i><span>{{ __('Cursus / Workshop') }}</span>
                    </a>
                </li>
            @endif
            <li class="{{ request()->is('email-setting*') ? 'active' : '' }}">
                <a href="{{ route('email_settings.index') }}"> <i
                        class="dripicons-document-edit"></i><span>{{ __('Instellingen e-mail') }}</span>
                </a>
            </li>
            <li class="{{ request()->is('verzoek_voor_wijzigingen*') ? 'active' : '' }}">
                <a href="{{ route('employee-request.index') }}"> <i
                        class="dripicons-user-group"></i><span>{{ __('Verzoek voor wijzigingen') }}</span>
                </a>
            </li>
    </ul>
    @endif
</div>
