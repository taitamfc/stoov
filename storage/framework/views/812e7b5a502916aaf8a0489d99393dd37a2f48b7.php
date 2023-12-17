<div class="main-menu">
    <ul id="side-main-menu" class="side-menu list-unstyled">
        <?php if(auth()->user()->role_users_id == \App\User::CLIENT): ?>
            <li class="mb-15 "><a href="<?php echo e(url('/client/dashboard')); ?>"> <i
                        class="dripicons-meter"></i><span><?php echo e(__('Dashboard')); ?></span></a></li>
            <li class="no-href color-green"><span><?php echo e(__('STOOV')); ?></span></li>
            <li><a href="<?php echo e(route('client-get-verletvergoeding')); ?>"><span> <i
                            class="dripicons-mail"></i><?php echo e(__('Verletvergoeding')); ?></span></a></li>
            <li><a href="<?php echo e(route('get-contact-training-grant')); ?>"><span> <i
                            class="dripicons-mail"></i><?php echo e(__('Opleidingsvergoeding')); ?></span></a></li>
            <?php if(!checkSubmitLoomsom()): ?>
            <li><a href="<?php echo e(route('client-get-loonsomopgave')); ?>"><span> <i
                            class="dripicons-mail"></i><?php echo e(__('Loonsomopgave')); ?></span></a></li>
            <?php endif; ?>
            <li class="mb-15 <?php echo e(request()->is('ingezonden_formulieren*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('course.index')); ?>"> <i
                        class="dripicons-mail"></i><span><?php echo e(__('Aanvragen')); ?></span>
                </a>
            </li>
            
            <?php if(checkShowVakcertificaten()): ?>
                <li class="no-href color-green">
                    <span><?php echo e(__('VAKCERTIFICATEN')); ?></span>
                </li>
            <?php endif; ?>
            <li class="no-href color-green"><span><?php echo e(__('KEURMERK')); ?></span></li>
            <li class="<?php echo e(request()->is('staff*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('employees.index')); ?>"> <i
                        class="dripicons-user-group"></i><span><?php echo e(__('Medewerkers')); ?></span></a>
            </li>
        <?php else: ?>
            <?php if(auth()->user()->role_users_id == \App\User::ADMINISTRATOR): ?>
                <li class="<?php echo e(request()->is('admin/dashboard*') ? 'active' : ''); ?>"><a
                        href="<?php echo e(url('/admin/dashboard')); ?>"> <i
                            class="dripicons-meter"></i><span><?php echo e(__('Dashboard')); ?></span></a>
                </li>
                <li class="no-href color-green"><span><?php echo e(__('STOOV')); ?></span></li>
            <?php endif; ?>
            <li class="<?php echo e(request()->is('ingezonden_formulieren*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('course.index')); ?>"> <i
                        class="dripicons-suitcase"></i><span><?php echo e(__('Aanvragen')); ?></span>
                </a>
            </li>
            <li class="<?php echo e(request()->is('loonsomopgaves*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('loonsomopgaves')); ?>"> <i
                        class="dripicons-suitcase"></i><span><?php echo e(__('Loonsomopgaves')); ?></span>
                </a>
            </li>
            <li class="<?php echo e(request()->is('beschikbare-budgetten*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('beschikbare-budgetten')); ?>"> <i
                        class="dripicons-jewel"></i><span><?php echo e(__('Beschikbare budgetten')); ?></span>
                </a>
            </li>
            <br />
            <li class="no-href color-green"><span><?php echo e(__('VAKCERTIFICATEN')); ?></span></li>
            <li class="<?php echo e(request()->is('organization*') ? 'active' : ''); ?>"><a href="<?php echo e(route('companies.index')); ?>">
                    <i class="dripicons-view-thumb"></i><span><?php echo e(__('Organisatie')); ?></span></a>
            </li>
            <li class="has-dropdown <?php echo e(request()->is('staff*') ? 'active' : ''); ?>">
                <a href="#employees" aria-expanded="false" data-toggle="collapse"> <i
                        class="dripicons-user-group"></i><span><?php echo e(__('Medewerkers')); ?></span></a>
                <ul id="employees" class="collapse list-unstyled ">
                    <li id="employee_list"><a href="<?php echo e(route('employees.index')); ?>"><?php echo e(__('Employee Lists')); ?></a>
                    </li>
                    <li id="user-import"><a href="<?php echo e(route('employees.import')); ?>"><?php echo e(__('Import Employees')); ?></a>
                    </li>
                    <li id="user-import"><a
                            href="<?php echo e(route('certificationImport')); ?>"><?php echo e(__('Certificering Importeren')); ?></a>
                    </li>
                </ul>
            </li>
            <br/>
            <li
                class="has-dropdown <?php if(request()->is('user*')): ?> <?php echo e(request()->is('user*') ? 'active' : ''); ?><?php elseif(request()->is('add-user*')): ?><?php echo e(request()->is('add-user*') ? 'active' : ''); ?> <?php endif; ?>">
                <a href="#users" aria-expanded="false" data-toggle="collapse">
                    <i class="dripicons-user"></i>
                    <span><?php echo e(__('User')); ?></span>
                </a>
                <ul id="users" class="collapse list-unstyled ">
                    <li id="users-menu"><a href="<?php echo e(route('users-list')); ?>"><?php echo e(__('Users List')); ?></a></li>
                    <li id="user-roles"><a href=<?php echo e(route('user-roles')); ?>><?php echo e(__('Assign Role')); ?></a></li>
                    <li id="user-last-login"><a href="<?php echo e(route('login-info')); ?>"><?php echo e(__('Users Last Login')); ?></a>
                    </li>
                </ul>
            </li>
            <li class="has-dropdown <?php echo e(request()->is('settings*') ? 'active' : ''); ?>">
                <?php if(auth()->user()->can('view-role') ||
                        auth()->user()->can('view-general-setting') ||
                        auth()->user()->can('access-language') ||
                        auth()->user()->can('access-variable_type') ||
                        auth()->user()->can('access-variable_method') ||
                        auth()->user()->can('view-general-setting')): ?>
                    <a href="#Customize_settings" aria-expanded="false" data-toggle="collapse">
                        <i class="dripicons-toggles"></i><span><?php echo e(__('Customize Setting')); ?></span>
                    </a>
                <?php endif; ?>
                <ul id="Customize_settings" class="collapse list-unstyled ">
                    <li id="roles"><a href="<?php echo e(route('roles.index')); ?>"><?php echo e(__('Roles and Access')); ?></a></li>
                    <li id="general_settings"><a
                            href="<?php echo e(route('general_settings.index')); ?>"><?php echo e(__('General Settings')); ?></a>
                    </li>

                    <li id="mail_setting"><a href="<?php echo e(route('setting.mail')); ?>"><?php echo e(__('Mail Setting')); ?></a>
                    </li>

                    <li id="language_switch"><a
                            href="<?php echo e(route('languages.translations.index', 'English')); ?>"><?php echo e(__('Language Settings')); ?></a>
                    </li>

                    <li id="variable_type"><a href="<?php echo e(route('variables.index')); ?>"><?php echo e(__('Variable Type')); ?></a>
                    </li>
                    <li id="variable_method"><a
                            href="<?php echo e(route('variables_method.index')); ?>"><?php echo e(__('Variable Method')); ?></a>
                    </li>
                    <li id="ip_setting"><a href="<?php echo e(route('ip_setting.index')); ?>"><?php echo e(__('IP Settings')); ?></a></li>
                </ul>
            </li>
            <li class="has-dropdown <?php echo e(request()->is('file_manager*') ? 'active' : ''); ?>">

                <a href="#file_manager" aria-expanded="false" data-toggle="collapse"> <i
                        class="dripicons-archive"></i><span><?php echo e(__('File Manager')); ?></span>
                </a>

                <ul id="file_manager" class="collapse list-unstyled ">

                    <li id="files"><a href="<?php echo e(route('files.index')); ?>"><?php echo e(__('File Manager')); ?></a>
                    </li>

                    <li id="official_documents"><a
                            href="<?php echo e(route('official_documents.index')); ?>"><?php echo e(__('Official Documents')); ?></a>
                    </li>

                    <li id="file_config"><a href="<?php echo e(route('file_config.index')); ?>"><?php echo e(__('File Configuration')); ?></a>
                    </li>
                </ul>
            </li>
            <?php if(auth()->user()->role_users_id == \App\User::ADMINISTRATOR): ?>
                <li class="has-dropdown <?php echo e(request()->is('importeren*') ? 'active' : ''); ?>">
                    <a href="#importeren" aria-expanded="false" data-toggle="collapse"> <i
                            class="dripicons-browser-upload"></i><span><?php echo e(__('Importeren')); ?></span>
                    </a>
                    <ul id="importeren" class="collapse list-unstyled importeren">
                        <li class="#">
                            <a href="<?php echo e(route('course.verletvergoeding-importeren')); ?>"><?php echo e(__('Verletvergoeding importeren')); ?></span>
                            </a>
                        </li>
                        <li class="#">
                            <a href="<?php echo e(route('course.opleidingsvergoeding-importeren')); ?>"><?php echo e(__('Opleidingsvergoeding importeren')); ?></span>
                            </a>
                        </li>
                        <li class="#">
                            <a href="<?php echo e(route('course.loonsomopgave-importeren')); ?>"><?php echo e(__('Loonsomopgave importeren')); ?></span>
                            </a>
                        </li>
                        <li class="#">
                            <a href="<?php echo e(route('budgets.importeren')); ?>"><?php echo e(__('Budgetten importeren')); ?></span>
                            </a>
                        </li>
                        <li class="#">
                            <a href="<?php echo e(route('klanten.importeren')); ?>"><?php echo e(__('Klanten importeren')); ?></span>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>
            <li class="<?php echo e(request()->is('verzoek_loonsomopgave*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('course.course-request')); ?>"> <i
                        class="dripicons-mail"></i><span><?php echo e(__('Verzoek loonsomopgave')); ?></span>
                </a>
            </li>
            <?php if(auth()->user()->role_users_id == \App\User::ADMINISTRATOR): ?>
                <li class="<?php echo e(request()->is('cursus-workshop*') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('naam_cursus.index')); ?>"> <i
                            class="dripicons-graduation"></i><span><?php echo e(__('Cursus / Workshop')); ?></span>
                    </a>
                </li>
            <?php endif; ?>
            <li class="<?php echo e(request()->is('email-setting*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('email_settings.index')); ?>"> <i
                        class="dripicons-document-edit"></i><span><?php echo e(__('Instellingen e-mail')); ?></span>
                </a>
            </li>
            <li class="<?php echo e(request()->is('verzoek_voor_wijzigingen*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('employee-request.index')); ?>"> <i
                        class="dripicons-user-group"></i><span><?php echo e(__('Verzoek voor wijzigingen')); ?></span>
                </a>
            </li>
    </ul>
    <?php endif; ?>
</div>
<?php /**PATH E:\laragon\www\stoov\resources\views/vendor/translation/menu.blade.php ENDPATH**/ ?>