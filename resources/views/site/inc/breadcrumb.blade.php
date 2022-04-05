  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        
      <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
      @if (!empty(Str::ucfirst(__($param1))))
      <li class="breadcrumb-item {{empty(Str::ucfirst(__($param2))) ? 'active' : ''}}" aria-current="page"> {{ Str::ucfirst(__($param1)) }}</li>
      @endif
      @if (!empty(Str::ucfirst(__($param2))))
      <li class="breadcrumb-item {{empty(Str::ucfirst(__($param3))) ? 'active' : ''}}" aria-current="page">{{ Str::ucfirst(__($param2)) }}</li>
      @endif
      @if (!empty(Str::ucfirst(__($param3))))
      <li class="breadcrumb-item active" aria-current="page">{{ Str::ucfirst(__($param3)) }}</li>
      @endif
    </ol>
  </nav>