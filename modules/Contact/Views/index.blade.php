@extends('layouts.home')
@push('css')
	<style type="text/css">
		.bravo-contact-block .section{
			padding: 80px 0 !important;
		}

        .breadcrumb {
            background-color: transparent !important;
        }
	</style>
@endpush
@section('content')
<div id="bravo_content-wrapper">
	@include("Contact::frontend.blocks.contact.index")
</div>
@endsection
