

<option value="" disabled selected >{{ __('Select Country') }}</option>
	@foreach (App\Models\Country::where('status',1)->where('id',101)->get() as $data)
	<option value="{{ $data->country_name }}" data="{{$data->id}}" rel5="{{ Auth::check() && Auth::user()->country == $data->country_name ? 1 : 0 }}" rel="{{$data->states->count() > 0 ? 1 : 0}}" rel1="{{Auth::check() ? 1 : 0}}" rel2="{{Auth::check() && Auth::user()->state_id ?  Auth::user()->state_id : 0}}" {{ Auth::check() && Auth::user()->country == $data->country_name ? 'selected' : '' }} data-href="{{route('country.wise.state',$data->id)}}">{{ $data->country_name }}</option>
@endforeach
