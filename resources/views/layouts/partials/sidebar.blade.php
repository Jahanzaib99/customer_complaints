<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ asset('adminAssets/dist/img/avatar5.png') }}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{ auth()->user()->name}}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li>
        <a href="{{ route('complaints.index') }}">
          <i class="fa fa-users"></i> <span>Complaints</span>
          {{-- <span class="pull-right-container">
            <small class="label pull-right bg-green">new</small>
          </span> --}}
        </a>
      </li>
      
    </ul>
  </section>