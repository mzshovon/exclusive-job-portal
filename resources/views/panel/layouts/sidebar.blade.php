<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('public/dist/img/icon.png') }}" alt="Exclusive Job Preparation Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-bold">Exclusive Job Preparation</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('public/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ url('/home') }}" class="nav-link {{ $title == 'Dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @if (Auth()->user()->hasRole('superadmin') ||
                    Auth()->user()->hasRole('admin'))
                    <li class="nav-item  has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-user-plus"></i>
                            <p>
                                System Users
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('user-create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add System User</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user-view') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>View System User</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if (Auth()->user()->hasRole('superadmin'))
                    <li
                        class="nav-item has-treeview {{ $title == 'Permissions' || $title == 'Add Permission' || $title == 'Update Permission' ? 'menu-open' : '' }}">
                        <a href="#"
                            class="nav-link {{ $title == 'Permissions' || $title == 'Add Permission' || $title == 'Update Permission' ? 'active' : '' }}">
                            <i class="nav-icon fa fa-unlock"></i>
                            <p>
                                Permission
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('permission-create') }}"
                                    class="nav-link {{ $title == 'Add Permission' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add Permission</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('permission-view') }}"
                                    class="nav-link {{ $title == 'Permissions' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>View Permission</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li
                        class="nav-item has-treeview {{ $title == 'Roles' || $title == 'Add Role' || $title == 'Update Role' ? 'menu-open' : '' }}">
                        <a href="#"
                            class="nav-link {{ $title == 'Roles' || $title == 'Add Role' || $title == 'Update Role' ? 'active' : '' }}">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                                Role
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('role-create') }}"
                                    class="nav-link {{ $title == 'Add Role' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add Role</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('role-view') }}"
                                    class="nav-link {{ $title == 'Roles' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>View Role</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if (Auth()->user()->hasRole('vendor') ||
                    Auth()->user()->hasRole('admin') ||
                    Auth()->user()->hasRole('superadmin'))
                    <li
                        class="nav-item has-treeview
          {{ $title == 'F.A.Q Section' ||
          $title == 'Create F.A.Q Section' ||
          $title == 'Update F.A.Q Section' ||
          $title == 'About Section' ||
          $title == 'Create About Section' ||
          $title == 'Update About Section' ||
          $title == 'videos' ||
          $title == 'Create video' ||
          $title == 'Update video' ||
          $title == 'Package Section' ||
          $title == 'Create Package Section' ||
          $title == 'Update Package Section' ||
          $title == 'Exams' ||
          $title == 'Create exam' ||
          $title == 'Update exam' ||
          $title == 'Store Exam questions' ||
          $title == 'Models' ||
          $title == 'Create model' ||
          $title == 'Update model' ||
          $title == 'Store Exam questions' ||
          $title == 'App section' ||
          $title == 'Create App Section' ||
          $title == 'Update App Section' ||
          $title == 'Store Exam questions' ||
          $title == 'subjects' ||
          $title == 'Create subject' ||
          $title == 'Update subject' ||
          $title == 'Store subject questions' ||
          $title == 'chapters' ||
          $title == 'Create chapter' ||
          $title == 'Update chapter' ||
          $title == 'Store chapter questions' ||
          $title == 'App Users' ||
          $title == 'Push Notification Section' ||
          $title == 'Create Push Notification Section' ||
          $title == 'Update Push Notification Section' ||
          $title == 'SMS Section' ||
          $title == 'Create message Section' ||
          $title == 'Update Message Section'
              ? 'menu-open'
              : '' }}">
                        <a href="#"
                            class="nav-link {{ $title == 'F.A.Q Section' ||
                            $title == 'Create F.A.Q Section' ||
                            $title == 'Update F.A.Q Section' ||
                            $title == 'About Section' ||
                            $title == 'Create About Section' ||
                            $title == 'Update About Section' ||
                            $title == 'videos' ||
                            $title == 'Create video' ||
                            $title == 'Update video' ||
                            $title == 'Package Section' ||
                            $title == 'Create Package Section' ||
                            $title == 'Update Package Section' ||
                            $title == 'Exams' ||
                            $title == 'Create exam' ||
                            $title == 'Update exam' ||
                            $title == 'Store Exam questions' ||
                            $title == 'Models' ||
                            $title == 'Create model' ||
                            $title == 'Update model' ||
                            $title == 'Store Exam questions' ||
                            $title == 'App section' ||
                            $title == 'Create App Section' ||
                            $title == 'Update App Section' ||
                            $title == 'Store Exam questions' ||
                            $title == 'subjects' ||
                            $title == 'Create subject' ||
                            $title == 'Update subject' ||
                            $title == 'Store subject questions' ||
                            $title == 'chapters' || $title == 'Create chapter' ||
                            $title == 'Update chapter' ||
                            $title == 'Store chapter questions' ||
                            $title == 'App Users' ||
                            $title == 'Push Notification Section' ||
                            $title == 'Create Push Notification Section' ||
                            $title == 'Update Push Notification Section' ||
                            $title == 'SMS Section' ||
                            $title == 'Create message Section' ||
                            $title == 'Update Message Section'
                                ? 'active'
                                : '' }}">
                            <i class="nav-icon fas fa-mobile"></i>
                            <p>
                                App
                                <i class="fas fa-angle-left right"></i>
                                {{-- <span class="badge badge-info right">6</span> --}}
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li
                                class="nav-item has-treeview {{ $title == 'App Users' ||
                                $title == 'Push Notification Section' ||
                                $title == 'Create Push Notification Section' ||
                                $title == 'Update Push Notification Section' ||
                                $title == 'SMS Section' ||
                                $title == 'Create message Section' ||
                                $title == 'Update Message Section'
                                    ? 'menu-open'
                                    : '' }}">
                                <a href="#"
                                    class="nav-link {{ $title == 'App Users' ||
                                    $title == 'Push Notification Section' ||
                                    $title == 'Create Push Notification Section' ||
                                    $title == 'Update Push Notification Section' ||
                                    $title == 'SMS Section' ||
                                    $title == 'Create message Section' ||
                                    $title == 'Update Message Section'
                                        ? 'active'
                                        : '' }}">
                                    <i class="nav-icon fas fa-user-tag"></i>
                                    <p>
                                        App User Section
                                        <i class="fas fa-angle-left right"></i>
                                        {{-- <span class="badge badge-info right">6</span> --}}
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('app-user-view') }}"
                                            class="nav-link {{ $title == 'App Users' ? 'active' : '' }}">
                                            <i class="fas fa-user-plus nav-icon"></i>
                                            <p>Registered App Users</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('view-push-notification') }}"
                                            class="nav-link {{ $title == 'Push Notification Section' || $title == 'Create Push Notification Section' || $title == 'Update Push Notification Section' ? 'active' : '' }}">
                                            <i class="fas fa-comment-alt nav-icon"></i>
                                            <p>Push Notification</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('view-sms-notification') }}"
                                            class="nav-link {{ $title == 'SMS Section' || $title == 'Create message Section' || $title == 'Update Message Section' ? 'active' : '' }}">
                                            <i class="fas fa-sms nav-icon"></i>
                                            <p>SMS Notification</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li
                                class="nav-item has-treeview {{ $title == 'Package Section' ||
                                $title == 'Create Package Section' ||
                                $title == 'Update Package Section' ||
                                $title == 'Exams' ||
                                $title == 'Create exam' ||
                                $title == 'Update exam' ||
                                $title == 'Store Exam questions' ||
                                $title == 'Models' ||
                                $title == 'Create model' ||
                                $title == 'Update model' ||
                                $title == 'App section' ||
                                $title == 'Create App Section' ||
                                $title == 'Update App Section' ||
                                $title == 'subjects' ||
                                $title == 'Create subject' ||
                                $title == 'Update subject' ||
                                $title == 'Store subject questions' ||
                                $title == 'chapters' ||
                                $title == 'Create chapter' ||
                                $title == 'Update chapter' ||
                                $title == 'Store chapter questions'
                                    ? 'menu-open'
                                    : '' }}">
                                <a href="#"
                                    class="nav-link {{ $title == 'Package Section' ||
                                    $title == 'Create Package Section' ||
                                    $title == 'Update Package Section' ||
                                    $title == 'Exams' ||
                                    $title == 'Create exam' ||
                                    $title == 'Update exam' ||
                                    $title == 'Store Exam questions' ||
                                    $title == 'Models' ||
                                    $title == 'Create model' ||
                                    $title == 'Update model' ||
                                    $title == 'Store Exam questions' ||
                                    $title == 'App section' ||
                                    $title == 'Create App Section' ||
                                    $title == 'Update App Section' ||
                                    $title == 'Store Exam questions' ||
                                    $title == 'subjects' ||
                                    $title == 'Create subject' ||
                                    $title == 'Update subject' ||
                                    $title == 'Store subject questions' ||
                                    $title == 'chapters' ||
                                    $title == 'Create chapter' ||
                                    $title == 'Update chapter' ||
                                    $title == 'Store chapter questions'
                                        ? 'active'
                                        : '' }}">
                                    <i class="nav-icon fas fa-box"></i>
                                    <p>
                                        Course Section
                                        <i class="fas fa-angle-left right"></i>
                                        {{-- <span class="badge badge-info right">6</span> --}}
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('package-view') }}"
                                            class="nav-link {{ $title == 'Package Section' || $title == 'Create Package Section' || $title == 'Update Package Section' ? 'active' : '' }}">
                                            <i class="fas fa-cubes nav-icon nav-icon"></i>
                                            <p>Packages</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('section-view') }}"
                                            class="nav-link  {{ $title == 'App section' || $title == 'Create App Section' || $title == 'Update App Section' ? 'active' : '' }}">
                                            <i class="fas fa-align-justify nav-icon"></i>
                                            <p>Sections</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('model-view') }}"
                                            class="nav-link {{ $title == 'Models' || $title == 'Create model' || $title == 'Update model' ? 'active' : '' }}">
                                            <i class="fas fa-scroll nav-icon"></i>
                                            <p>Models</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('subject-view') }}"
                                            class="nav-link {{ $title == 'subjects' || $title == 'Create subject' || $title == 'Update subject' || $title == 'Store subject questions' ? 'active' : '' }}">
                                            <i class="fas fa-book nav-icon"></i>
                                            <p>Subjects</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('chapter-view') }}"
                                            class="nav-link {{ $title == 'chapters' || $title == 'Create chapter' || $title == 'Update chapter' || $title == 'Store chapter questions' ? 'active' : '' }}">
                                            <i class="fas fa-book nav-icon"></i>
                                            <p>Chapters</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('exam-view') }}"
                                            class="nav-link {{ $title == 'Exams' ||
                                            $title == 'Create exam' ||
                                            $title == 'Update exam' ||
                                            $title == 'Store questions' ||
                                            $title == 'Update questions'
                                                ? 'active'
                                                : '' }}">
                                            <i class="fas fa-check-square nav-icon"></i>
                                            <p>Exams</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('faq-view') }}"
                                    class="nav-link {{ $title == 'F.A.Q Section' || $title == 'Create F.A.Q Section' || $title == 'Update F.A.Q Section' ? 'active' : '' }}">
                                    <i class="fas fa-question nav-icon"></i>
                                    <p>F.A.Q</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('about-view') }}"
                                    class="nav-link {{ $title == 'About Section' || $title == 'Create About Section' || $title == 'Update About Section' ? 'active' : '' }}">
                                    <i class="fas fa-address-card nav-icon"></i>
                                    <p>About</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('video-view') }}"
                                    class="nav-link {{ $title == 'videos' || $title == 'Create video' || $title == 'Update video' ? 'active' : '' }}">
                                    <i class="fas fa-video nav-icon"></i>
                                    <p>Video</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- <li class="nav-item">
            <a href="pages/gallery.html" class="nav-link">
              <i class="nav-icon far fa-copy"></i>
              <p>
                Invoice
              </p>
            </a>
          </li> --}}
                @endif
                <li class="nav-header">Tools</li>
                <li class="nav-item">
                    <a href="{{ route('profile-view') }}" class="nav-link">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                            Profile
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
