<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.0.2.js"></script>
    <link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link href="{{ asset('css/colorpicker.css') }}" rel="stylesheet" />
    <script src="{{ asset('js/colorpicker.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/1.7.11/fabric.min.js"></script>
    <!--<link href="css/common.css" rel="stylesheet" />-->
    <style type="text/css">

        #warning-message {
            display: none;
        }

        .touchpad-container {
            padding-left: 100px;
        }
        .canvas-container {
            position: absolute !important;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }

        .options-panel {
            /*display: none;*/
            position: fixed;
            height: 100%;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 10000;
            background: #1e1e1e;
        }

        .options {
            width: 100px;
        }

            .options ul {
                background: #1e1e1e;
            }

            .options li {
                display: table;
                vertical-align: middle;
            }

            .options .btn {
                display: table-cell;
                height: 50px;
                white-space: normal;
                line-height: 1.2;
                font-size: 12px;
                color: white;
                vertical-align: middle;
                /*img {
                            display: none;
                        }*/
            }

            .options .fa {
                display: block;
                font-size: 18px;
            }

        ul.level-1 > li {
            position: relative;
            display: table;
            border-bottom: 1px solid rgba(255, 255, 255, 0.7);
            width: 100%;
        }

            ul.level-1 > li:hover > ul.level-2 {
                display: block;
            }

        ul.level-2 {
            display: none;
            overflow: hidden;
            width: 500px;
            position: absolute;
            top: 0;
            left: 100px;
        }

            ul.level-2 li {
                float: left;
            }

        #sketchContainer {
            overflow: hidden;
            position: relative;
            max-width: 100%;
                    width: 100% !important;
            max-height: 100vh;
            height: 100vh;

        background-color:rgb(240,240,240);
        }

        #colorSelector {
            position: relative;
            display: inline-block;
            width: 36px;
            height: 36px;
            background: url(../images/select.png);
        }

        .color-info {
            display: inline-block;
        }

        #colorSelector div {
            position: absolute;
            top: 3px;
            left: 3px;
            width: 30px;
            height: 30px;
            background: url(../images/select.png) center;
        }

        .options ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .upper-button {
            border-bottom-left-radius: 0px;
            border-bottom-right-radius: 0px;
        }

        .bottom-button {
            border-top-left-radius: 0px;
            border-top-right-radius: 0px;
        }

        .black-pick:hover {
            background-color: #000;
            border-color: #000;
        }

        .black-pick {
            background-color: #202020;
            border-color: #202020;
        }

        /*#sketchContainer {
            max-height: 100vh;
            min-height: 100vh;
        }*/
        #sketchMain {
            /*max-width: 100%;*/
            width: 100% !important;
            height: 100% !important;
            position: relative;
        }

        #text_tool {
            position: absolute;
            border: 1px dashed black;
            outline: 0;
            display: none;
            font: 10px Verdana;
            overflow: hidden;
            white-space: nowrap;
        }

        #sketch {
            max-width: 100%;
            width: 100% !important;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }
        #togetherjs-dock
        {
            position: absolute !important;
        }

        .object-options {
            width: auto;
            display: none;
            position: absolute;
            background: skyblue;
                z-index: 9999;
        }
        .object-options ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .object-options li {
            display: inline-block;
            padding: 0;
            margin: 0;
        }
        .object-options.show {
            display: block;
        }
        /*#togetherjs-dock {
    top: calc(50% - 130px);
    right: 0;
}*/
        /*.togetherjs {
    position: fixed;
    top: 20px;
    right: 30px;
}

        #togetherjs-dock {
            position: static !important;
        }*/
    </style>
    <title>TogetherJS Drawing Example</title>
    <script type="text/javascript" src="{{ asset('js/board-fabric.js') }}"></script>

      <script>
          //var TogetherJSConfig_autoStart = true;
          var TogetherJSConfig_suppressJoinConfirmation = true;

          //TogetherJSConfig_cloneClicks = "";
          var TogetherJSConfig_ignoreMessages = [];
          var TogetherJSConfig_dontShowClicks = ":not(canvas";
          var TogetherJSConfig_ignoreForms = true;
  </script>
    <script src="https://togetherjs.com/togetherjs-min.js"></script>
    <!--<script src="cursor.js"></script>-->
    <!--<script src="togetherjsPackage.js"></script>-->

</head>
<body>
    <!--<input type="file" id="imgLoader">-->
    <!--<div id="warning-message">
        this website is only viewable in landscape mode
    </div>-->
    <div class="object-options">
        <ul>
            <li>
                width: <input type="text" class="object-width" />
            </li>
            <li>
                height: <input type="text" class="object-height" />
            </li>
        </ul>
    </div>
    <div class="options-panel">
        <div class="user-info">
        </div>
        <div class="options">
            <ul class="level-1">
                <li>
                    <a class="btn colors">
                        <i class="fa fa-cogs" aria-hidden="true"></i>
                        Colors
                    </a>
                    <ul class="level-2">
                        <li>
                            <a class="btn color-picker upper-button" data-color="blue">Blue</a>
                        </li>
                        <li>
                            <a class="btn color-picker" data-color="green">Green</a>
                        </li>
                        <li>
                            <a class="btn color-picker" data-color="yellow">Yellow</a>
                        </li>
                        <li>
                            <a class="btn color-picker" data-color="red">Red</a>
                        </li>
                        <li>
                            <a class="btn color-picker upper-button" data-color="black">Black</a>
                        </li>
                        <li>
                            <a class="btn user-color-pick bottom-button">User Color</a>
                        </li>
                        <li>
                            <div id="colorSelector" class="color-selector stroke">
                                <div style="background-color: #0000ff">
                                </div>
                            </div>
                            <div class="color-info">
                                <input type="text" class="color-picker hex" disabled>
                                <input type="text" class="color-picker rgb" disabled>
                            </div>
                        </li>
                        <li>
                            <div id="colorSelector" class="color-selector fill">
                                <div style="background-color: #0000ff"></div>
                            </div>
                            <div class="color-info">
                                <input type="text" class="color-picker hex" disabled>
                                <input type="text" class="color-picker rgb" disabled>
                            </div>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="btn sizes">
                        <i class="fa fa-arrows" aria-hidden="true"></i>
                        Size & Shape
                    </a>
                    <ul class="level-2">
                        <li>
                            <a class="btn plus-size">
                                <i class="fa fa-plus-square"></i>
                            </a>
                        </li>
                        <li>
                            <input type="number" name="size" id="size" class="size-text" min="2">
                        </li>
                        <li>
                            <a class="btn minus-size">
                                <i class="fa fa-minus-square"></i>
                            </a>
                        </li>
                        <li>
                            <a class="btn square-shape">
                                <i class="fa fa-square"></i>
                            </a>
                        </li>
                        <li>
                            <a class="btn round-shape">
                                <i class="fa fa-circle"></i>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="btn tools">
                        <i class="fa fa-cogs" aria-hidden="true"></i>
                        Tools
                    </a>
                    <ul class="level-2">
                        <li>
                            <a class="btn tool-picker" data-tool="line">line</a>
                        </li>
                        <li>
                            <a class="btn tool-picker" data-tool="pen">pen</a>
                        </li>
                        <li>
                            <a class="btn tool-picker" data-tool="rect">rect</a>
                        </li>
                        <li>
                            <a class="btn tool-picker" data-tool="circle">circle</a>
                        </li>
                        <li>
                            <a class="btn tool-picker" data-tool="triangle">triangle</a>
                        </li>
                        <li>
                            <a class="btn tool-picker" data-tool="text">text</a>
                        </li>
                        <li>
                            <a class="btn tool-picker" data-tool="select">select</a>
                        </li>
                        <li>
                            <a class="btn eraser bottom-button">
                                <i class="fa fa-eraser"></i>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="btn undo">
                        <i class="fa fa-undo" aria-hidden="true"></i>
                        Undo
                    </a>
                </li>
                <li>
                    <a class="btn redo">
                        <i class="fa fa-repeat" aria-hidden="true"></i>
                        Redo
                    </a>
                </li>
                <li>
                    <a class="btn clear">
                        <i class="fa fa-times-circle"></i>
                        Clear
                    </a>
                </li>
                <li>
                    <a class="btn save-sketch" href="#">
                        <i class="fa fa-cloud" aria-hidden="true"></i>
                        Save sketch
                    </a>
                </li>
                <li>
                    <input type="file" id="imgLoader">
                </li>
                <li>
                    <a id="imgSaver" class="btn" href="#">
                        <i class="fa fa-cloud" aria-hidden="true"></i>
                        Save image
                    </a>
                </li>
                <li>
                    <a onclick="TogetherJS(this); return false;" class="btn">
                        <i class="fa fa-user-plus" aria-hidden="true"></i>
                        Collab
                    </a>
                </li>
            </ul>
            <div class="saved-sketches"></div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="touchpad-container">
        <div id="sketchContainer">
            <canvas id="c" width="1920" height="1080"></canvas>
        </div>
    </div>
    <!--<script src="fabric_settings.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ramda/0.19.0/ramda.min.js"></script>
        <!--<script src="annotator.js"></script>-->
</body>
</html>
