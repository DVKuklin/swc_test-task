<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    @auth
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <div class="d-block text-white" id="user"></div>
            </div>
        </div>

        <nav class="mt-2">
        <ul id="all_events_list" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        </ul>
        <ul id="my_events_list" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-header font-weight-bold"><h4>Мои события</h4></li>
        </ul>
      </nav>

        <a href="/events/create" class="btn btn-primary">Создать событие</a>
    @endauth
</div>