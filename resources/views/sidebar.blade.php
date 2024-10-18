<div class="sidebar">
    <div class="logo-details">
        <i class="bx bx-menu"></i>
      <span class="logo_name">H-Soft Corp.</span>
    </div>
    <ul class="nav-links">
      <li>
        <a href="{{route('dashboard')}}">
          <i class='bx bx-grid-alt' ></i>
          <span class="link_name">Dashboard</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Category</a></li>
        </ul>
      </li>
      {{-- <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-book-alt' ></i>
            <span class="link_name">Posts</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Posts</a></li>
          <li><a href="#">Web Design</a></li>
          <li><a href="#">Login Form</a></li>
          <li><a href="#">Card Design</a></li>
        </ul>
      </li> --}}
      <li>
        <div class="icon-link">
          <a href="{{route('lettersgrid')}}">
            <i class='bx bx-file' ></i>
            <span class="link_name">Letters</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="{{route('lettersgrid')}}">Letters</a></li>
          <li><a href="{{route('lettercreate')}}">New Letter</a></li>
          <li><a href="#">Forward Letter</a></li>
          <li><a href="#">Box Icons</a></li>
        </ul>
      </li>
      <li>
        <div class="icon-link">
          <a href="#">
            <i class='bx bx-history' ></i>
            <span class="link_name">Tracking</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Tracking</a></li>
          <li><a href="{{route('inbox')}}">Inbox</a></li>
          <li><a href="{{route('outbox')}}">Outbox</a></li>
          <li><a href="{{route('sending')}}">Ready for Sending</a></li>
          <li><a href="{{route('sentitems')}}">Sent Letters</a></li>
          
        </ul>
      </li>
      <li>
        <div class="icon-link">
          <a href="{{route('users.index')}}">
            {{-- <i class='bx bx-plug' ></i> --}}
            <i class='bx bx-user'></i>
            <span class="link_name">Users</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="{{route('users.index')}}">Users</a></li>
          <li><a href="{{route('users.index')}}">Users Grid</a></li>
          <li><a href="{{route('users.create')}}">Add Users</a></li>
          <li><a href="{{route('roles.index')}}">Roles Gird</a></li>
          <li><a href="{{route('roles.create')}}">Add Role</a></li>
        </ul>
      </li>
      <li>
        <div class="icon-link">
          <a href="{{route('officersGrid')}}">
            {{-- <i class='bx bx-plug' ></i> --}}
            <i class='bx bxs-user-rectangle'></i>
            <span class="link_name">Officers</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="{{route('officersGrid')}}">Officers</a></li>
          <li><a href="{{route('newofficer')}}">Add Officer</a></li>
        </ul>
      </li>
      <li>
        <div class="icon-link">
          <a href="{{route('section.index')}}">
            <i class='bx bx-buildings'></i>
            <span class="link_name">Sections</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="{{route('section.index')}}">Sections</a></li>
          <li><a href="{{route('section.create')}}">Add Section</a></li>
        </ul>
      </li>
      <li>
        <div class="icon-link">
          <a href="{{route('files.index')}}">
            <i class='bx bx-folder-open'></i>
            <span class="link_name">Files</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="{{route('files.index')}}">Files</a></li>
          <li><a href="{{route('files.create')}}">Add File</a></li>
        </ul>
      </li>
      <hr style="color: white">
      <li>
        <div class="icon-link">
          <a href="{{route('section.index')}}">
            <i class='bx bxs-user-circle'></i>
            <span class="link_name">Profile</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="{{route('section.index')}}">Profile</a></li>
          <li><a href="{{route('logout')}}">Logout</a></li>
        </ul>
      </li>
    {{-- <div class="profile-details">
      <i class='bx bx-download' ></i>
      <div class="profile-content">
        
      </div>
      <div class="name-job">
        <div class="profile_name">Prem Shahi</div>
        <div class="job">Web Desginer</div>
      </div>
      <i class='bx bx-log-out' ></i>
    </div> --}}
  </li>
</ul>
</div>
