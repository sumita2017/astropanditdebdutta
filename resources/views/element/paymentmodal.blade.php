<!-- Modal -->
<div class="modal fade" id="paymentmodal" tabindex="-1" aria-labelledby="paymentmodal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Payment for <span class="paymentlinkname"></span>
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item paymentlinkname">
                        </p>
                    </li>
                    <li class="list-group-item paymentlinkemail">
                        </p>
                    </li>
                    <li class="list-group-item paymentlinkphonenumber">
                        </p>
                    </li>
                    <li class="list-group-item paymentlinkbookingdate">
                        </p>
                    </li>
                </ul>
                <form class="user" id="paymentform" method="POST" action="{{ URL::to('paymentlinkcreate') }}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="mb-3">
                        <label for="basic-url" class="form-label">Amount</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="hidden" name="name" class="paymentformname" value="">
                            <input type="hidden" name="email" class="paymentformemail" value="">
                            <input type="hidden" name="id" class="paymentformappointmentid" value="">
                            <input type="hidden" name="phonenumber" class="paymentformphone" value="">
                            <input type="text" class="form-control" aria-label="Amount" required>
                            <span class="input-group-text">.00</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Create Payment Link</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>