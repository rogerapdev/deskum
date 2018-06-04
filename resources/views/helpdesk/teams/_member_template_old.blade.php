<div class="members-template" style="display: none;">
	<div class="row">
		<div class="col-md-12">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text bg-white border-right-0 pt-0 pb-0 align-middle col-md-6 col-sm-6 col-6">
                        {{-- <div class="checkbox"> --}}
                            <label class="mb-1">
                                <input type="radio" name="memberships[][admin]" value="1" class="styled"> Administrador
                            </label>
                        {{-- </div> --}}
                    </div>
                </div>
                {{ Form::select('memberships[][user_id]', [], '', array('class' => 'form-control')) }}
                <div class="input-group-append">
                    <span class="input-group-text bg-white border-left-0 text-danger" id="delete-member"><i class="im im-cross3"></i></span>
                </div>
            </div>
		</div>
	</div>
</div>


{{-- <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text">$</span>
  </div>
  <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
  <div class="input-group-append">
    <span class="input-group-text">.00</span>
  </div>
</div> --}}

{{-- <div class="members-template" style="display: none;">
    <div class="row">
        <div class="col-md-12">
            <div class="input-group">
                <div class="input-group-text bg-white border-right-0 pt-0 pb-0 align-middle col-md-6 col-sm-6 col-6">
                    <div class="checkbox">
                        <label class="mb-1">
                            <input type="radio" name="memberships[][admin]" value="1" class="styled"> Administrador
                        </label>
                    </div>
                </div>
                {{ Form::select('memberships[][user_id]', [], '', array('class' => 'form-control')) }}
                <div class="input-group-append">
                    <span class="input-group-text bg-white border-left-0 text-danger" id="delete-member"><i class="im im-cross3"></i></span>
                </div>
            </div>
        </div>
    </div>
</div>
 --}}


{{-- <div class="row">
    <div class="col-md-12">
        <div class="col-md-12">
            <div class="input-group">
                <div class="input-group-prepend  pt-0 pb-0 align-middle pr-3">
                            <label class="mb-1">
                    <input type="radio" name="memberships[][admin]" value="1" class="styled"> Administrador
                            </label>
                </div>
                {{ Form::select('memberships[][user_id]', [], '', array('class' => 'form-control')) }}
                <div class="input-group-append">
                    <span class="input-group-text bg-white border-left-0 text-danger" id="delete-member"><i class="im im-cross3"></i></span>
                </div>
            </div>
        </div>
    </div>
</div> --}}
