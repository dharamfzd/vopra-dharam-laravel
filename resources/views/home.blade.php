@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if (Session::has('message'))
                        <div class="alert alert-{{ Session::get('status') }}" role="alert">
                            {{ Session::get('message') }}
                        </div>
                    @endif
                    <form class="" action="{{ route('price-save') }}" method="post">
                      @csrf
                      <div class="table-responsive">
                        <table class="table table-bordered">
                          <thead>
                              @php $i=0 @endphp
                              @foreach($numbers as $key => $number)
                              @if($i==0) <tr> @endif
                                <th>
                                  Price : {{ $key }}
                                  <input type="text" name="price[]" value="{{ old('price.'.$key) }}">
                                  <input type="hidden" name="id[]" value="{{ $number->id }}">
                                  @if ($errors->has('price.'.$key))
                                      <small class="text-danger">{{ $errors->first('price.'.$key) }}</small>
                                  @endif
                                </th>
                              @if($i==10) </tr> @endif
                              @php $i++;  if($i==10)  $i=0 ; @endphp
                              @endforeach
                          </thead>
                        </table>
                      </div>
                      <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary my-4">Save</button>
                      </div>
                  </form>

                  <div class="table-responsive">
                      <table class="table table-bordered">
                        <tbody>
                            @php $i=0 @endphp
                            @foreach($totals as $key => $number)
                              @if($i==0) <tr> @endif
                              <td>
                                <b>Price : {{ $key }} </b><br>
                                <input type="text" value="Sum = {{ $number->total_price }}" readonly>
                              </td>
                              @if($i==10) </tr> @endif
                            @php $i++;  if($i==10)  $i=0 ; @endphp
                            @endforeach
                        </tbody>
                      </table>
                  </div>
               </div>
            </div>
        </div>
    </div>
</div>
@endsection
