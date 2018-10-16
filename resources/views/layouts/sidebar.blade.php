<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">
        <div>
            <p class="app-sidebar__user-name">{{Auth::user()->name}}</p>
            <p class="app-sidebar__user-designation">Frontend Developer</p>
        </div>
    </div>
    <ul class="app-menu">
        <li><a class="app-menu__item {{Route::is('home') ? 'active' : ''}}" href="{{route('home')}}"><i
                        class="app-menu__icon fa fa-dashboard"></i><span
                        class="app-menu__label">Dashboard</span></a></li>
        <li class="treeview {{setActive('personal*', 'is-expanded')}}"><a class="app-menu__item" href="#"
                                                                          data-toggle="treeview"><i
                        class="app-menu__icon fa fa-laptop"></i><span
                        class="app-menu__label">My {{config('app.name')}}</span><i
                        class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li>
                    <a class="treeview-item {{Route::is('task.index') ? 'active' : ''}}" href="{{route('task.index')}}">
                        <i class="icon fa fa-circle-o"></i> My tasks
                    </a>
                </li>
                <li>
                    <a class="treeview-item {{Route::is('github.list') ? 'active' : ''}}" href="{{route('github.list')}}">
                        <i class="icon fa fa-circle-o"></i> Github projects
                    </a>
                </li>
                <li>
                    <a class="treeview-item {{Route::is('expense.index') ? 'active' : ''}}" href="{{route('expense.index')}}">
                        <i class="icon fa fa-circle-o"></i> My Expenses
                    </a>
                </li>
                <li>
                    <a class="treeview-item {{Route::is('expense.stats') ? 'active' : ''}}" href="{{route('expense.stats')}}">
                        <i class="icon fa fa-circle-o"></i> Expense stats
                    </a>
                </li>
                <li>
                    <a class="treeview-item {{Route::is('gallery.index') ? 'active' : ''}}" href="{{route('gallery.index')}}">
                        <i class="icon fa fa-circle-o"></i> My galleries
                    </a>
                </li>
                <li>
                    <a class="treeview-item {{Route::is('gallery.add') ? 'active' : ''}}" href="{{route('gallery.add')}}">
                        <i class="icon fa fa-circle-o"></i> Gallery add
                    </a>
                </li>
                <li>
                    <a class="treeview-item {{Route::is('document.index') ? 'active' : ''}}" href="{{route('document.index')}}">
                        <i class="icon fa fa-circle-o"></i> My Documents
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>
