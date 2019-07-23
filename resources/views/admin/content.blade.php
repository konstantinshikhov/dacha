<div class="content-wrapper">

  @if (session('success'))
    <div class="alert alert-success" style="border-radius: 0;">{{ session('success') }}</div>
  @endif
  @if (session('warning'))
    <div class="alert alert-warning" style="border-radius: 0;">{{ session('warning') }}</div>
  @endif

  @if(!empty($modelName))
  <section class="content-header">
    <h1>
      {{ $modelName }}
      <!--small>Optional description</small-->
    </h1>
  </section>
  @endif

  <section class="content container-fluid">
    @yield('form')
  </section>

</div>

@section('script')
@parent
<script type="text/javascript">
window.setTimeout(function() {
  $('.alert').slideUp('fast');
}, 2000);
</script>
@endsection