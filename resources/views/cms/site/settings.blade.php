@extends('cms.layouts.app')
@section('content')
	<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			@include('cms.layouts.breadcrumb')
		</div>
	</div>
	<div class="d-flex flex-column-fluid">
		<div class="container">
			<div class="card card-custom">
				<div class="card-header flex-wrap py-5">
					<div class="card-title">
						<h3 class="card-label">Genel Ayarlar
							<div class="text-muted pt-2 font-size-sm">Genel Ayarlar</div>
						</h3>
					</div>
				</div>
				<form class="form" action="{{url('tavsiocms/site/settings/edit')}}" method="post">
					{{csrf_field()}}
					<div class="card-body">
						<div class="form-group row">
							<div class="col-lg-6">
								<label>Site Adı:</label>
								<input type="text" name="name" class="form-control" value="{{$site->name}}"/>
							</div>
							<div class="col-lg-6">
								<label>Title (Ana Sayfa):</label>
								<input type="text" name="title" class="form-control" value="{{$site->title}}"/>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-6">
								<label>Description (Ana Sayfa):</label>
								<input type="text" name="description" class="form-control"
								       value="{{$site->description}}"/>
							</div>
							<div class="col-lg-6">
								<label>Youtube Video Kodu (Ana Sayfa) :</label>
								<input type="text" name="youtubecode" class="form-control"
								       value="{{$site->youtubecode}}"/>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-6">
								<label>App Store Link :</label>
								<input type="text" name="app_store" class="form-control"
								       value="{{$site->app_store}}"/>
							</div>
							<div class="col-lg-6">
								<label>Google Play Link :</label>
								<input type="text" name="google_play" class="form-control"
								       value="{{$site->google_play}}"/>
							</div>
						</div>

						<div class="form-group mt-1 mb-1">
							<label for="exampleTextarea">Footer Açıklama (Kısa Tanıtım) :</label>
							<textarea class="form-control" id="footer" name="footer"
							          rows="3">{{$site->footer}}</textarea>
						</div>

						<div class="card-footer">
							<div class="row">
								<div class="col-lg-6">
									<button type="submit" class="btn btn-success mr-2 btn-sm font-weight-bolder">
										<i class="fas fa-save"></i> Formu Kaydet ve Kapat
									</button>
									<a href="{{url('tavsiocms')}}"
									   class="btn btn-light-danger font-weight-bolder btn-sm">
										<i class="far fa-times-circle"></i> İptal Et
									</a>
								</div>
							</div>
						</div>
				</form>
			</div>
		</div>
	</div>
@endsection
@section('js')
	<script type="text/javascript">
		var ozeldersDatatable = false;
	</script>
@endsection
@section('cssFiles')
	<style>
		#why, #footer, #main {
			height: 150px;
		}

		#agreement {
			height: 400px;
		}
	</style>
@endsection
