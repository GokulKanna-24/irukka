@include('layouts.partials.header')
<!-- ===============================================-->
<!--    Main Content-->
<!-- ===============================================-->
<main class="main" id="top">

  @include('layouts.partials.topbar')
  @include('layouts.partials.main', ['shops' => $shops])
  @include('layouts.partials.bottombar')
  
</main>
</script>
<!-- ===============================================-->
<!--    End of Main Content-->
<!-- ===============================================-->
@include('layouts.partials.footer')
