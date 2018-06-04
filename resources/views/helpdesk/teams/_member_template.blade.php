<div class="members-template" style="display: none;">
	<div class="row">
        <div class="col-md-9 col-sm-9 col-9">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-white border-right-0 text-danger" id="delete-member"><i class="im im-cross3"></i></span>
                </div>
                {{ Form::select('memberships[][user_id]', Dependency::optionsSelect('App\Models\User'), '', array('class' => 'form-control')) }}
            </div>
        </div>
        <div class="col-md-3 col-sm-3 col-3">
            <div class="form-group">
                <input type="radio" name="memberships[][admin]" value="1">
            </div>
        </div>
	</div>
</div>
