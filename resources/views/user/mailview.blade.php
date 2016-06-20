@extends('layout.index_layout')

@section('content')
		<div class="container">
        	<div class="row">
            	<div class="col-md-12">
                    <ol class="breadcrumb">
                    	  <li><a href="{{ route('home') }}">Home</a></li>
                    	  <li><a href="{{ route('mymail') }}">My Messages</a></li>
                          <li class="active">Mail View</li>
                    </ol>
                </div>
            </div>
        </div>
        
        <div class="container margin_bottom_15">
        	<div class="row">
            	<div class="col-md-12">
                    <ul class="nav nav-pills">
                      <li role="presentation"><a href="{{ url('myprofile') }}">My Profile</a></li>
                      <li role="presentation"><a href="{{ url('myads') }}">My Classifieds</a></li>
                      <li role="presentation" class="active"><a href="{{ url('mymail') }}">My Messages</a></li>
                    </ul>
                </div>
            </div>
        </div>
        
        
        <div class="container margin_bottom_15">
        	<div class="row">
            	<div class="col-md-12">
                    
                    <?if(!$mailList->isEmpty()){?>
                        
                        <?foreach($mailList as $k => $v){?>
                            <?if($v->user_id_from == Auth::user()->user_id){?>
                                <div class="media">
                                    
                                    <div class="media-body">
                                        <h4>{{ $v->name }}</h4>
                                        <p>{!! $v->mail_text !!}</p>
                                        <p><small class="text-muted">{{ $v->mail_date }}</small></p>
                                    </div>
                                    
                                    <div class="media-right">
                                        <a href="{{ url('ad/user/' . Auth::user()->user_id) }}">
                                        
                                            <?if(empty(Auth::user()->avatar)){?>
                                                <img class="media-object" src="{{ 'https://www.gravatar.com/avatar/' . md5(trim(Auth::user()->email)) . '?s=100&d=identicon' }}" alt="{{ Auth::user()->name }}">
                                            <?} else {?>
                                                <img class="media-object" src="{{ asset('uf/udata/100_' . Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}">
                                            <?}?>
                                        
                                        </a>
                                    </div>
                                </div>
                            <?} else {?>
                                <div class="media">
                                    <div class="media-left">
                                        <a href="{{ url('ad/user/' . $v->user_id) }}">
                                        
                                            <?if(empty($v->avatar)){?>
                                                <img class="media-object" src="{{ 'https://www.gravatar.com/avatar/' . md5(trim($v->email)) . '?s=100&d=identicon' }}" alt="{{ $v->name }}">
                                            <?} else {?>
                                                <img class="media-object" src="{{ asset('uf/udata/100_' . $v->avatar) }}" alt="{{ $v->name }}" >
                                            <?}?>
                                        
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h4>{{ $v->name }}</h4>
                                        <p>{!! $v->mail_text !!}</p>
                                        <p><small class="text-muted">{{ $v->mail_date }}</small></p>
                                    </div>
                                </div>
                            <?}?>
                            
                            <hr>
                        <?}//end of foreach?>
                        
                        <a href="{{ route('maildelete', ['hash' => $hash]) }}" class="btn btn-danger need_confirm btn-sm">Delete Conversation</a>
                        
                    <?} else {?>
                        <div class="alert alert-info">You dont't have messages.</div>
                    <?}?>
                    
                </div>
            </div>
            
            <!-- send message form -->
            @if (session()->has('message'))
			    <div class="alert alert-info">{{ session('message') }}</div>
			@endif
            
            <div class="row">
            	<div class="col-md-12">
                	<h4>Send Message</h4>
                </div>
            </div>
            
            <div class="row margin_bottom_15">   
                <div class="col-md-12">
                    <form method="POST">
                        {!! csrf_field() !!}
                        
                        <div class="form-group required {{ $errors->has('contact_message') ? ' has-error' : '' }}">
                            <label for="contact_message" class="control-label">Message</label>
                            <textarea class="form-control" rows="7" name="contact_message" id="contact_message">{{ old('contact_message') }}</textarea>
                            @if ($errors->has('contact_message'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('contact_message') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>
                </div>
            </div>
            <!-- end of send message form -->
            
            
            
        </div>
        
        
                    
        
        
        
        
        
@endsection