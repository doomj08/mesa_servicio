@extends('layouts.app')

@section('style-id')
    <style type="text/css">
        .service_card {
            background: hsla(0, 0%, 81%, 0.36);
            padding-left: 0;
            padding-right: 0;
            border-radius: 8px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 service_card">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color: rgba(48,151,209,0.5) !important;">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 style="margin-top: 1%" class="h3_form">
                                    <i class="fas fa-file-alt"></i>&nbsp;
                                    <b>Servicio N° {{ $ticket->id}}</b></h4>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{ url('servicios_all')}}"
                                   data-toggle="tooltip"
                                   data-placement="top"
                                   title="Regresar"
                                   class="btn btn-primary">
                                    <i class="fas fa-reply"></i>
                                </a>
                                @if($ticket->etat !== 'Terminado' && is_null($param))
                                    <a href="{{ url('servicio/'.$ticket->id.'/traiter')}}"
                                       class="btn btn-primary">Responder</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="ui blue table"
                                       style="border-left: 1px solid #2a88bd;
                                       border-right: 1px solid #2a88bd;
                                       border-bottom: 1px solid #2a88bd;">
                                    <tr>
                                        <td width="22%" style="border-right: 1px solid #1e77ba">Título</td>
                                        <td>{{ $ticket->subject}}</td>
                                    </tr>
                                    <tr>
                                        <td style="border-right: 1px solid #1e77ba">Mensaje</td>
                                        <td>{{ $ticket->message}}</td>
                                    </tr>
                                    <tr>
                                        <td style="border-right: 1px solid #1e77ba">Prioridad</td>
                                        <td>{{ $ticket->priorite->nom}}</td>
                                    </tr>
                                    <tr>
                                        <td style="border-right: 1px solid #1e77ba">Estado</td>
                                        <td>{{ $ticket->etat}}</td>
                                    </tr>
                                    <tr>
                                        <td style="border-right: 1px solid #1e77ba">Fecha Creación :</td>
                                        <td>{{ $ticket->created_at}}</td>
                                    </tr>
                                    <tr>
                                        <td style="border-right: 1px solid #1e77ba">Usuario :</td>
                                        <td>{{ $ticket->user->name}}</td>
                                    </tr>
                                </table>
                                @if(count($ticket->files) >= 1)
                                    <div class="panel" style="border: 1px solid rgba(48,151,209,0.5)">
                                        <div class="panel-heading" style="background-color: rgba(48,151,209,0.5) !important;">
                                            <h4 style="color: whitesmoke !important;">Imágenes cargadas</h4>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row gallery">
                                                @foreach($ticket->files as $archive)
                                                    <div class="col-xs-6 col-md-3">
                                                        <a href="{{ $archive->url_path }}" class="thumbnail">
                                                            <img src="{{ $archive->url_path }}"
                                                                 alt="{!! $archive->name_file !!}">
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if(count($traitements) >= 1)
                                    <table class="ui blue table">
                                        <tr>
                                            <td>Descripción</td>
                                            <td>Tiempo</td>
                                            <td>Agente</td>
                                            <td>Fecha</td>
                                        </tr>
                                        @foreach ($traitements as $traitement)
                                            <tr>
                                                <td>{{ $traitement->description }}</td>
                                                <td>{{ $traitement->duree }} min</td>
                                                <td>{{ $traitement->technicien->name }}</td>
                                                <td>{{ $traitement->created_at }}</td>
                                            </tr>
                                        @endforeach

                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.gallery a').simpleLightbox();
        });
    </script>
@endpush
