<!DOCTYPE html>
<html lang="[LOCALE]">
    <head>
        <title>[GENERIC_TITLE]</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="refresh" content="200" >
        <!-- Bootstrap -->
        <link href="[CSS]bootstrap.min.css" rel="stylesheet" />
        <link href="[CSS]bootstrap-datepicker3.min.css" rel="stylesheet" />
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link href="[CSS]style.css" type="text/css" rel="stylesheet"/>
    </head>
    <body>
        <div class="wrapper">
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">[IMG_BRAND] [GENERIC_TITLE]</a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav"><!-- class="active"-->
                            <li><a href="home">[HOME_PAGE]</a></li>
                            <li><a href="about">[ABOUT_PAGE]</a></li>
                            <li><a href="contact">[CONTACT_PAGE]</a></li>
                        </ul>
                        [USER_PANEL]
                    </div>
                </div>
            </nav>
            <div class="container">
                <!--// Text modal //-->
                <button type="button" id="modal_generic_btn" class="btn btn-primary hidden" data-toggle="modal" data-target="#modal-generic"></button>
                <div id="modal-generic" class="modal fade" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"></h4>
                            </div>
                            <div class="modal-body">
                                <p></p>
                                <br />
                                <button type="button" class="btn btn-primary center-block" data-dismiss="modal">[CLOSE]</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!--// DeleteModal //-->
                <button type="button" id="modal_delete_btn" class="btn btn-primary hidden" data-toggle="modal" data-target="#modal-delete"></button>
                <div id="modal-delete" class="modal fade" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content panel-danger">
                            <div class="modal-header panel-heading">
                                <h4 class="modal-title">[GENERIC_TITLE_DELETE]</h4>
                            </div>
                            <div class="modal-body">
                                <p>[GENERIC_BODY_DELETE] <strong></strong>?</p>
                                <br />
                                <div class="text-center">
                                    <form class="btn" method="post" autocomplete="off" action="">
                                        <input type="hidden" name="id" id="id" />
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">[CLOSE]</button>
                                            <button type="submit" class="btn btn-danger">[DELETE]</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--// IMG modal //-->
                <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">[CLOSE]</span></button>
                                <h4 class="modal-title" id="image-gallery-title"></h4>
                            </div>
                            <div class="modal-body">
                                <img id="image-gallery-image" class="img-responsive" src="">
                            </div>
                            <div class="modal-footer">
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-primary" id="show-previous-image">[GENERIC_PREV]</button>
                                </div>
                                <div class="col-md-8 text-justify" id="image-gallery-caption"></div>
                                <div class="col-md-2">
                                    <button type="button" id="show-next-image" class="btn btn-default">[GENERIC_NEXT]</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>