<div class="request-card card">
    <div class="card-body">
        <form method="POST" action="/dispatch/{{$customerRequest->id}}/update_dispatch" class="row" id="request-form">
            @csrf
            <table class="table">
                <thead>
                    <tr>
                        <th>Printer Serial</th>
                        <th>Printer Model</th>
                        <th>Toners Serial</th>
                        <th>Toners Name</th>
                        <th>Last Sent Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customerRequest->details as $detail)
                        <tr>
                            <td>{{$customerRequest->company_printer->serial_number}}</td>
                            <td>{{$customerRequest->company_printer->printer->model}}</td>
                            <td>{{$detail->toner->part_number}}</td>
                            <td>{{$detail->toner->name}}</td>
                            <td>{{$customerRequest->last_sent($detail->request_type_id)}}</td>
                            <td><input type="checkbox" name="details_id[]" required value="{{$detail->id}}" {{$customerRequest->status=='dispached' ? 'disabled' : ''}}></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
    </div>
</div>
<div class="request-card card">
    <div class="card-body">
        @foreach($customerRequest->comments as $comment)
            <p class="comment-text" style="font-size: 12.4px;"><i>{{$comment->created_at->format('Y-m-d')}}&nbsp;>>&nbsp;{{$comment->comment}}</i></p>
        @endforeach
        <form method="POST" action="/dispatch/{{$customerRequest->id}}/comment" class="row">
            @csrf
            <label for="comment" class="form-label"  style="font-size: 12.4px;">Comment</label><br />
            <textarea name="comment" class="form-control" col="10" id="comment" required></textarea>                                                    
            <div class="text-end">
                <br />
                <input type="submit" class="btn btn-secondary" style="height: 30px;font-size: 12px;" value="Save">
                <a class="btn btn-primary" style="height: 30px;font-size: 12px;" onclick="submit_dspatch()">Dispatch</a>
            </div>
        </form>
    </div>
</div>

<script>
    function submit_dspatch(){
        $myForm = $('#request-form');
        if($myForm[0].checkValidity()){
            $myForm.submit();
        }else{
            $myForm[0].reportValidity()
        }
    }
    
</script>
