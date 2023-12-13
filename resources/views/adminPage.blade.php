@extends('master')

@section('content')


  <section class="content">
    <main>
      <div class="head-title">
        <div class="left">
          <h1>Dashboard</h1>
          <ul class="breadcrumb">
            <li>
              <a href="#">Dashboard</a>
            </li>
            <i class="fas fa-chevron-right"></i>
            <li>
              <a href="#" class="active">Home</a>
            </li>
          </ul>
        </div>


      </div>

      <div class="box-info">
        <li>
            <i class="fas fa-people-group"></i>
            <span class="texts" style="line-height: 1.0;
            margin-bottom: -25px">
              <h3>3M</h3>
              <p>Customers</p>
            </span>
          </li>
        <li>
          <i class="fas fa-people-group"></i>
          <span class="texts" style="line-height: 1.0;
          margin-bottom: -25px">
            <h3>1M</h3>
            <p>Vendors</p>
          </span>
        </li>

      </div>

      <div class="table-data">
        <div class="order">
          <div class="head">
            <h3>Customers</h3>
            {{-- <i class="fas fa-search"></i>
            <i class="fas fa-filter"></i> --}}
          </div>

          <table>
            <thead>
              <tr>
                <th>User</th>
                <th>Created Date</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <img src="profile.png" alt="" />
                  <p>User Name</p>
                </td>
                <td>07-05-2023</td>
                <td><button class="status pending">Deactivate</button></td>
                <td><button class="status complete"  style="    margin-left: -100px">Activate</button></td>
              </tr>
              <tr>
                <td>
                  <img src="profile.png" alt="" />
                  <p>User Name</p>
                </td>
                <td>07-05-2023</td>
                <td><button class="status pending">Deactivate</button></td>
                <td><button class="status complete"  style="    margin-left: -100px">Activate</button></td>
              </tr>
              <tr>
                <td>
                  <img src="profile.png" alt="" />
                  <p>User Name</p>
                </td>
                <td>07-05-2023</td>
                <td><button class="status pending">Deactivate</button></td>
                <td><button class="status complete"  style="    margin-left: -100px">Activate</button></td>
              </tr>
              <tr>
                <td>
                  <img src="profile.png" alt="" />
                  <p>User Name</p>
                </td>
                <td>07-05-2023</td>
                <td><button class="status pending">Deactivate</button></td>
                <td><button class="status complete"  style="    margin-left: -100px">Activate</button></td>
              <tr>
                <td>
                  <img src="profile.png" alt="" />
                  <p>User Name</p>
                </td>
                <td>07-05-2023</td>
                <td><button class="status pending">Deactivate</button></td>
                <td><button class="status complete"  style="    margin-left: -100px">Activate</button></td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="order">
            <div class="head">
              <h3>Vendors</h3>
              {{-- <i class="fas fa-search"></i>
              <i class="fas fa-filter"></i> --}}
            </div>

            <table>
              <thead>
                <tr>
                  <th>User</th>
                  <th>Created Date</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <img src="profile.png" alt="" />
                    <p>User Name</p>
                  </td>
                  <td>07-05-2023</td>
                  <td><button class="status pending">Deactivate</button></td>
                  <td><button class="status complete"  style="    margin-left: -100px">Activate</button></td>
                </tr>
                <tr>
                  <td>
                    <img src="profile.png" alt="" />
                    <p>User Name</p>
                  </td>
                  <td>07-05-2023</td>
                  <td><button class="status pending">Deactivate</button></td>
                  <td><button class="status complete"  style="    margin-left: -100px">Activate</button></td>
                </tr>
                <tr>
                  <td>
                    <img src="profile.png" alt="" />
                    <p>User Name</p>
                  </td>
                  <td>07-05-2023</td>
                  <td><button class="status pending">Deactivate</button></td>
                  <td><button class="status complete"  style="    margin-left: -100px">Activate</button></td>
                </tr>
                <tr>
                  <td>
                    <img src="profile.png" alt="" />
                    <p>User Name</p>
                  </td>
                  <td>07-05-2023</td>
                  <td><button class="status pending">Deactivate</button></td>
                  <td><button class="status complete"  style="    margin-left: -100px">Activate</button></td>
                <tr>
                  <td>
                    <img src="profile.png" alt="" />
                    <p>User Name</p>
                  </td>
                  <td>07-05-2023</td>
                  <td><button class="status pending">Deactivate</button></td>
                  <td><button class="status complete"  style="    margin-left: -100px">Activate</button></td>
                </tr>
              </tbody>
            </table>
          </div>
      </div>
    </main>
  </section>


@endsection
