@section('scripts')

<script src="{!! asset('theme/vendor/jquery/jquery.min.js') !!}"></script>
<script src="{!! asset('theme/vendor/popper.js/popper.min.js') !!}"></script>
<script src="{!! asset('theme/vendor/bootstrap/js/bootstrap.min.js') !!}"></script>
<script src="{!! asset('theme/vendor/chart.js/chart.min.js') !!}"></script>
<script src="{!! asset('theme/vendor/icheck/icheck.min.js') !!}"></script>
<script src="{!! asset('theme/vendor/select2/select2.min.js') !!}"></script>
<script src="{!! asset('theme/vendor/select2/i18n/pt-BR.js') !!}"></script>
<script src="{!! asset('theme/vendor/duallistbox/jquery.bootstrap-duallistbox.js') !!}"></script>
<script src="{!! asset('theme/vendor/slugify/slugify.min.js') !!}"></script>
<script src="{!! asset('theme/vendor/jquery-scrollbar/jquery.scrollbar.js') !!}"></script>
<script src="{!! asset('theme/vendor/air-datepicker/datepicker.js') !!}"></script>
<script src="{!! asset('theme/vendor/air-datepicker/i18n/datepicker.pt-BR.js') !!}"></script>


<script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>

<script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/pt.js"></script>

<script src="{!! asset('theme/js/carbon.js') !!}"></script>
<script src="{!! asset('theme/js/demo.js') !!}"></script>

<script src="{!! asset('js/jquery.mask.js') !!}"></script>
<script src="{!! asset('js/jquery.maskMoney.js') !!}"></script>
<script src="{!! asset('js/request-validate.js') !!}"></script>

<script src="{!! asset('js/custom.js') !!}"></script>

	<script type="text/javascript">
		var url_validation = '<?=url("ajax/validation");?>';
		Popper.Defaults.modifiers.computeStyle.gpuAcceleration = false;

		$('.show-filters').on('click', function(e){

			$('.filters').toggle();
			$('.list-result').toggle();

			$(this).find('i').toggleClass('icon-magnifier').toggleClass('icon-list');


		});

		$(document).ready(function(){
		    $('.scrollbar-inner').scrollbar();
		});
	</script>

@show
