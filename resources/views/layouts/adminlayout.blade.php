<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <!-- Title -->
  <title>{{ env('APP_NAME') }}</title>
  <link rel="icon" type="image/x-icon" href="{{ URL::to('admin/img/llogoicon-01-01.png') }}" />

  <link href="{{ URL::to('admin/css/style.min.css') }}" rel="stylesheet" />
  <link href="{{ URL::to('admin/css/styles.css') }}" rel="stylesheet" />
  <!-- <script src="{{ URL::to('admin/js/fontawesomeall.js') }}" crossorigin="anonymous"></script> -->
  <link href="{{ URL::to('admin/css/all.css') }}" rel="stylesheet" />

  <!-- text editor -->
  <script src="{{ URL::to('admin/js/jquery.min.js') }}"></script>
  <script src="{{ URL::to('tinymce/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
  <link rel="stylesheet" href="{{ URL::to('chosen/docsupport/style.css') }}">
  <link rel="stylesheet" href="{{ URL::to('chosen/docsupport/prism.css') }}">
  <link rel="stylesheet" href="{{ URL::to('chosen/chosen.css') }}">

</head>

<body class="sb-nav-fixed">

  @stack('style')

  <style type="text/css">
    from .dropdown-item {
      display: block;
      width: 100%;
      padding: var(--bs-dropdown-item-padding-y) var(--bs-dropdown-item-padding-x);
      clear: both;
      font-weight: 400;
      color: var(--bs-dropdown-link-color);
      text-align: inherit;
      text-decoration: none;
      white-space: nowrap;
      background-color: transparent;
      border: 0;
    }

    table.servicetable tbody td {
      word-break: break-word !important;
      vertical-align: top !important;
      width: 20%;
    }

    table.datatablereview thead tr th:last-child {
      word-break: break-word !important;
      vertical-align: top !important;
      width: 20%;
    }


    table.servicetable tbody td a {
      margin: 10px !important;
    }

    .chosen-container-multi {
      width: 100% !important;
    }

    div.accordion-item div.accordion-collapse div.accordion-body p {
      max-width: 100% !important;
    }

    #topbutton {
      display: none;
      position: fixed;
      bottom: 20px;
      right: 30px;
      z-index: 99;
      font-size: 18px;
      border: none;
      outline: none;
      background-color: #455e47;
      color: white;
      cursor: pointer;
      padding: 15px;
      border-radius: 4px;
    }

    #topbutton:hover {
      background-color: #555;
    }

    .p-bottom-20 {
      padding-bottom: 20px;
    }

    .code {
      color: aquamarine;
      background-color: black;
    }

    .code:focus {
      color: aquamarine;
      background-color: black;
    }

    ul li {
      list-style: none !important;
    }
  </style>
  @include('element.adminheader')
  <div id="layoutSidenav">

    @include('element.adminsidebar')

    <div id="layoutSidenav_content">
      <!-- Main content -->
      <button id="topbutton" title="Go to top"><i class="fa-solid fa-angle-up"></i></button>
      @yield('content')
      @include('element.adminfooter')
    </div>
  </div>
  <!-- End of Main Content -->
  @include('element.modal')
  @include('element.paymentmodal')

  <!-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script> -->

  <script src="{{ URL::to('admin/js/bootstrap.bundle.min.js') }}" crossorigin="anonymous"></script>
  <script src="{{ URL::to('admin/js/scripts.js') }}"></script>
  <script src="{{ URL::to('admin/js/simple-datatables.min.js') }}" crossorigin="anonymous"></script>
  <script src="{{ URL::to('admin/js/datatables-simple-demo.js') }}"></script>
  <script src="{{ URL::to('admin/js/bootbox.min.js') }}"></script>
  <script src="{{ URL::to('admin/js/bootbox.js') }}"></script>

  <!-- multiselect -->
  <script src="{{ URL::to('chosen/chosen.jquery.js') }}" type="text/javascript"></script>
  <script src="{{ URL::to('chosen/docsupport/prism.js') }}" type="text/javascript" charset="utf-8"></script>
  <script src="{{ URL::to('chosen/docsupport/init.js') }}" type="text/javascript" charset="utf-8"></script>


  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  @stack('scripts')
  @include('element.jqueryscripts')

</body>

</html>