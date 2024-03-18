<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Simple Table</title>
  <link rel="stylesheet">
  <style>
  /* Basic styling for the table */
    .simple-table {
    border-collapse: collapse;
    width: 100%;
    border: 2px solid black; /* Border color and thickness */
    }

    .simple-table th, .simple-table td {
    border: 1px solid black; /* Border for table cells */
    padding: 8px; /* Padding for content within cells */
    text-align: left; /* Align text to the left within cells */
    }
    #statement_title {
        text-align: center;
        font-size: 26px;
        font-weight: semi-bold;
    }
  </style>
</head>
<body>
    <div>
        <h3>Good Day Mr./Ms. {{$record->user_information->last_name}},</h3>
        <p>Your request has been approved. Your Request Code is  <span style="font-weight: bold; text-decoration: underline">{{$record->request_number}}</span></p>
        <p>Date Requested: <span style="font-weight: bold;">{{Carbon\Carbon::parse($record->created_at)->format('F d, Y h:i A')}}</span></p>
        <p>Date Approved: <span style="font-weight: bold;">{{Carbon\Carbon::parse($record->approved_at)->format('F d, Y h:i A')}}</span></p>
        <p>Approved By: <span style="font-weight: bold;">{{ucwords($record->approvedBy->name)}}</span></p>
        <p>Remarks: <span style="font-weight: bold;">{{ucwords($record->remarks)}}</span></p>
        <p>Total: <span style="font-weight: bold;">₱{{number_format($record->total_amount, 2)}}</span></p>
    </div>
<div>
    <p id="statement_title">Documents</p>
</div>
<table class="simple-table">
  <thead>
    <tr>
      <th>Document Title</th>
      <th>Quantity</th>
      <th>With Authentication</th>
      {{-- <th>Subtotal</th> --}}
    </tr>
  </thead>
  <tbody>
    @foreach ($record->documents()->get() as $item)
    <tr>
        <td class="border border-gray-500 px-4 py-2 text-center">{{strtoupper($item->title)}}</td>
        <td class="border border-gray-500 px-4 py-2 text-center">{{$item->pivot->quantity}}</td>
        <td class="border border-gray-500 px-4 py-2 text-center">{{$item->pivot->is_authenticated == 1 ? 'Yes' : 'No'}}</td>
        {{-- <td class="border border-gray-500 px-4 py-2 text-right">₱ {{number_format($item->pivot->amount, 2)}}</td> --}}
    </tr>
    @endforeach
{{--
    <tr>
        <td class=" px-4 py-2 text-right font-bold">Total: </td>
        <td class=" px-4 py-2 text-right font-bold"></td>
        <td class=" px-4 py-2 text-right font-bold"></td>
        <td class=" px-4 py-2 text-right font-bold">₱ {{number_format($record->total_amount, 2)}}</td>
    </tr> --}}
  </tbody>
</table>
<div style="margin-top: 50px">
    {{now()}} End of Message.
</div>
</body>
</html>
