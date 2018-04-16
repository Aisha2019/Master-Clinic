@extends('admin.layouts.layout')

@section('title')
  {{-- here goes the title of page --}}
  Invoice
@endsection

@section('css')
  
@endsection

@section('body')
  {{-- here goes content of pages --}}


@if (session('status'))
  <div class="alert alert-success">{{ session('status') }}</div>
@endif
<div >
  <!-- Main content -->
    <section class="invoice" >
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            
  <img src="{{ asset('/user_styles/images/testlogo.png') }}" /> Master Clinic
            <small class="pull-right">Date: {{ $invoice->date}}  {{ $invoice->time}} </small>
             
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          From :
          <address>
            <strong>{{ $clinic->name }}</strong><br>
            {{ $clinic->address }}<br>
            Phone: {{ $clinic->telephone }}<br>
            Email: {{ $clinic->email }}
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          To :
          <address>
            <strong>{{ $patient->name }}</strong><br>
            Phone: {{ $patient->mobile }}<br>
            Email: {{ $patient->email }}
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Invoice # {{ $invoice->id }}</b><br>
          <b>Payment Due: </b> {{ $invoice->date}}<br>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

       <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          Doctor :
          <address>
            <strong>{{ $admin->name }}</strong><br>
            Phone: {{ $admin->telephone }}<br>
            Email: {{ $admin->email }}
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          Nurse :
          <address>
            <strong>{{ $nurse->name }}</strong><br>
            Phone: {{ $nurse->mobile }}<br>
            Email: {{ $nurse->email }}
          </address>
        </div>
        
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Qty</th>
              <th>Product</th>
              <th>Serial #</th>
              <th>Description</th>
              <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td>1</td>
              <td>Call of Duty</td>
              <td>455-981-221</td>
              <td>El snort testosterone trophy driving gloves handsome</td>
              <td>$64.50</td>
            </tr>
            <tr>
              <td>1</td>
              <td>Need for Speed IV</td>
              <td>247-925-726</td>
              <td>Wes Anderson umami biodiesel</td>
              <td>$50.00</td>
            </tr>
            <tr>
              <td>1</td>
              <td>Monsters DVD</td>
              <td>735-845-642</td>
              <td>Terry Richardson helvetica tousled street art master</td>
              <td>$10.70</td>
            </tr>
            <tr>
              <td>1</td>
              <td>Grown Ups Blue Ray</td>
              <td>422-568-642</td>
              <td>Tousled lomo letterpress</td>
              <td>$25.99</td>
            </tr>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        
        <!-- /.col -->
        <div class="col-xs-6">
          <p class="lead">Amount Due 2/22/2014</p>

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td>$250.30</td>
              </tr>
              <tr>
                <th>Tax (9.3%)</th>
                <td>$10.34</td>
              </tr>
              <tr>
                <th>Shipping:</th>
                <td>$5.80</td>
              </tr>
              <tr>
                <th>Total:</th>
                <td>$265.24</td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
          
        </div>
      </div>
    </section>
  </div>
@endsection

@section('js')
  {{-- here goes js files --}}
  
@endsection