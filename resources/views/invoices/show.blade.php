@extends('layouts.app')

@section('content')
<div class="container">
  <div class="card">
    <div class="card-content">
      <p class="title">
        {{ $invoice->title }}
      </p>
      @if( $invoice->status === 'pending' || Auth::user()->hasAnyRole(['inquisitor','superadmin']))
      <a class="button" id="delete-modal"> Delete </a>
      @endif
      @hasanyrole('inquisitor|superadmin')
      <p class="label"> {{ __('app.applicant') }} :</p>
      {{ $invoice->user->fullname }}
      @endhasanyrole
      <p class="label"> {{ __('fields.status') }} </p>
      @if( $invoice->status === 'pending')
      <span class="tag is-warning">{{__('app.pending')}}</span>
      @elseif( $invoice->status === 'validated')
      <span class="tag is-success">{{__('app.validated')}}</span>
      @else
      <span class="tag is-danger">{{__('app.denied')}}</span>
      @endif
      <p class="label"> Description :</p>
      {{ $invoice->description }}
      <p class="label"> Date :</p>
      {{ $invoice->date->format('d M y') }}
      <p class="label"> {{ __('fields.files') }} : </p>
      @if( $download )
      <a class="button" href="{{ route('download_invoice', ['id'=>$invoice->id]) }}">
        {{ __('fields.download') }} {{ $invoice->getFirstMedia('invoice')->file_name }}
      </a>
      @else
      <div class="invoice-img">
        <a href="{{ url('medias/'.$invoice->getFirstMedia('invoice')->id) }}">
          <img src="{{ url('medias/'.$invoice->getFirstMedia('invoice')->id) }}">
        </a>
        <br>
        <a class="button" href="{{ route('download_invoice', ['id'=>$invoice->id]) }}">
          {{ __('fields.download') }} {{ $invoice->getFirstMedia('invoice')->file_name }}
        </a>
      </div>
      @endif
      @hasanyrole('inquisitor|superadmin')
      <a href="{{ route('invoice_status', ['id' => $invoice->id, 'status' => 'validated' ])}}" class="button is-primary"> {{ __('app.validate_invoice') }} </a>
      <a href="{{ route('invoice_status', ['id' => $invoice, 'status' => 'denied' ])}}" class="button is-danger"> {{ __('app.denied_invoice') }} </a>
      @endhasanyrole
    </div>
  </div>
  @include('parts.modal_delete', [
    'delete_route' => route('invoices.destroy', ['id' => $invoice->id]),
    'modal_message' => 'Are you sure to delete this invoice ?',
    'modal_title' => 'Delete an invoice'
    ])
</div>
@endsection
