<div class="scrollbar side-menu-bg" style="overflow-x: hidden;">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{ route('dashboard') }}" data-target="#dashboard">
                <div class="pull-left"><i class="ti-home"></i><span
                        class="right-nav-text">{{ trans('main_trans.Dashboard') }}</span>
                </div>

                <div class="clearfix"></div>
            </a>

        </li>
        <!-- Grades-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Grades-menu">
                <div class="pull-left">
                    <i class="ti-widget"></i>
                    <span class="right-nav-text">{{ trans('main_trans.Grades_list') }}</span>
                </div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Grades-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{ route('grades.index') }}">{{ trans('main_trans.Grades') }}</a></li>

            </ul>
        </li>
        {{-- classes --}}
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#classroom-menu"
                aria-expanded="{{ Route::is('classrooms.index') ? 'true' : 'false' }}">
                <div class="pull-left"><i class="fa fa-building"></i><span
                        class="right-nav-text">{{ trans('main_trans.List_classes') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="classroom-menu" class="collapse {{ Route::is('classrooms.index') ? 'show' : '' }}"
                data-parent="#sidebarnav">
                <li> <a href="{{ route('classrooms.index') }}">{{ trans('main_trans.classes') }}</a>
                </li>
            </ul>
        </li>

        {{-- sections --}}
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#sections-menu"
                aria-expanded="{{ Route::is('sections.index') ? 'true' : 'false' }}">
                <div class="pull-left">
                    <i class="fa fa-window-maximize"></i>
                    <span class="right-nav-text">{{ trans('main_trans.List_sections') }}</span>
                </div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="sections-menu" class="collapse {{ Route::is('sections.index') ? 'show' : '' }}"
                data-parent="#sidebarnav">
                <li> <a href="{{ route('sections.index') }}">{{ trans('main_trans.sections') }}</a>
                </li>
            </ul>
        </li>

        <!-- Parents-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Parents-menu">
                <div class="pull-left"><i class="fa fa-users"></i><span
                        class="right-nav-text">{{ trans('main_trans.Parents') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Parents-menu" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ url('add_parent') }}">{{ trans('main_trans.List_Parents') }}</a>
                </li>
            </ul>
        </li>

        <!-- Teachers-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Teachers-menu">
                <div class="pull-left"><i class="fa fa-graduation-cap"></i><span
                        class="right-nav-text">{{ trans('main_trans.Teachers') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Teachers-menu" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('teachers.index') }}">{{ trans('main_trans.List_Teachers') }}</a>
                </li>
            </ul>
        </li>
        <!-- students -->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#students-menu">
                <i class="ti-user"></i>
                {{ trans('main_trans.students') }}<div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="students-menu" class="collapse">
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse"
                        data-target="#Student_information">{{ trans('main_trans.Student_information') }}
                        <div class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="Student_information" class="collapse">
                        <li> <a href="{{ route('students.create') }}">{{ trans('main_trans.add_student') }}</a>
                        </li>
                        <li> <a href="{{ route('students.index') }}">{{ trans('main_trans.list_students') }}</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" data-toggle="collapse"
                        data-target="#Students_upgrade">{{ trans('main_trans.Students_Promotions') }}<div
                            class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="Students_upgrade" class="collapse">
                        <li> <a href="{{ route('promotions.index') }}">{{ trans('main_trans.add_Promotion') }}</a>
                        </li>
                        <li> <a
                                href="{{ route('promotions.create') }}">{{ trans('main_trans.list_Promotions') }}</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" data-toggle="collapse"
                        data-target="#Graduate students">{{ trans('main_trans.Graduate_students') }}<div
                            class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="Graduate students" class="collapse">
                        <li> <a href="{{ route('graduated.create') }}">{{ trans('main_trans.add_Graduate') }}</a>
                        </li>
                        <li> <a href="{{ route('graduated.index') }}">{{ trans('main_trans.list_Graduate') }}</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>


        <!-- Accounts-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Accounts-menu">
                <div class="pull-left"><i class="fa fa-money" aria-hidden="true"></i><span
                        class="right-nav-text">{{ trans('main_trans.Accounts') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Accounts-menu" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('fees.index') }}">الرسوم الدراسية</a> </li>
                <li> <a href="{{ route('fees_invoices.index') }}">الفواتير</a> </li>
                <li> <a href="{{ route('receipt_students.index') }}">سندات القبض</a> </li>
                <li> <a href="{{ route('processing_fee.index') }}">استبعاد رسوم</a> </li>
                <li> <a href="{{ route('payment_students.index') }}">سندت الصرف</a> </li>
            </ul>
        </li>

        <!-- Attendance-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Attendance-icon">
                <div class="pull-left"><i class="fa fa-calendar"></i><span
                        class="right-nav-text">{{ trans('main_trans.Attendance') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Attendance-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('attendances.index') }}">قائمة الطلاب</a> </li>
            </ul>
        </li>
        <!-- menu item todo-->

        <!-- Subjects-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#subject-icon">
                <div class="pull-left"><i class="fa fa-book"></i><span class="right-nav-text">المواد
                        الدراسية</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="subject-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('subjects.index') }}">قائمة المواد</a> </li>
            </ul>
        </li>

        <!-- Quizzes-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Exams-icon">
                <div class="pull-left"><i class="fa fa-question"></i><span class="right-nav-text">الاختبارات</span>
                </div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Exams-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('quizzes.index') }}">قائمة الاختبارات</a> </li>
                <li> <a href="{{ route('questions.index') }}">قائمة الاسئلة</a> </li>
            </ul>
        </li>


        <!-- Online classes-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Onlineclasses-icon">
                <div class="pull-left"><i class="fa fa-video-camera"></i><span
                        class="right-nav-text">{{ trans('main_trans.Onlineclasses') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Onlineclasses-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('online_classes.index') }}">حصص اونلاين مع زوم</a> </li>
            </ul>
        </li>

        <!-- library-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#library-icon">
                <div class="pull-left"><i class="fa fa-book"></i><span
                        class="right-nav-text">{{ trans('main_trans.library') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="library-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('library.index') }}">قائمة الكتب</a> </li>
            </ul>
        </li>


        <!-- Settings-->
        <li>
            <a href="{{ route('settings.index') }}"><i class="fa fa-cogs"></i><span
                    class="right-nav-text">{{ trans('main_trans.Settings') }} </span></a>
        </li>







    </ul>
</div>
