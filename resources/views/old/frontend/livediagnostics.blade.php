@extends('layouts.front')
@section('content')
@include('partials.global.common-header')

<div class="dignostics-banner">
   <div class="dignostics-images py-2 px-4">
      <h1>LIVE SKIN ANALYZER</h1>
      <p>Integrate skin analysis online seamlessly with our AI Skin <br> Analyzer.
         It provides real-time skin diagnosis, assessing <br> concerns, skin type, and age. </p>
   </div>
</div>

<div class="live-result py-5">
   <div class="dignostic-result">
      <h1 class="text-center">Live Diagnostic Results</h1>
   </div>
</div>

<div class="skin-age">
   <div class="container">
      <div class="row">
         <div class="col-lg-5">
            <div class="camera-access-title">
            <video id="video" width="480" height="480" autoplay></video>
            <canvas id="canvas" width="600" height="480" style="display:none;"></canvas>
            </div>
         </div>
         <div class="col-lg-7">
            <div class="skincare-feature-panel-pc pf-mobile-d-none">
               <div class="skincare-feature-panel-pc__summary-container">
                  <div class="skincare-feature-panel-pc__summary">Skin Age: <img alt="loading" src="https://d3ss46vukfdtpo.cloudfront.net/static/media/analyzing-dots.bf09fa60.gif" class="skincare-feature-panel-pc__summary-loading"></div>
               </div>
               <div class="skincare-feature-panel-pc__score-container">
                  <div class="skin-diagnostic__circle-container pf-language pf-language-en skincare-feature-panel-pc__score" style="width: auto; display: flex;">
                     <div class="skin-diagnostic__circle-skinType skin-diagnostic__circle" style="cursor: default; border-color: rgb(169, 138, 130); position: static;"><img alt="loading" src="https://d3ss46vukfdtpo.cloudfront.net/static/media/analyzing-dots.bf09fa60.gif" style="width: 85%;"></div>
                     <div class="skin-diagnostic__circle-name">Skin Type</div>
                  </div>
                  <div class="skin-diagnostic__circle-container pf-language pf-language-en skincare-feature-panel-pc__score" style="width: auto; display: none;">
                     <div class="skin-diagnostic__circle-skinType skin-diagnostic__circle" style="cursor: default; border-color: rgb(169, 138, 130); position: static;"><img alt="loading" src="https://d3ss46vukfdtpo.cloudfront.net/static/media/analyzing-dots.bf09fa60.gif" style="width: 85%;"></div>
                     <div class="skin-diagnostic__circle-name">T-zone</div>
                  </div>
                  <div class="skin-diagnostic__circle-container pf-language pf-language-en skincare-feature-panel-pc__score" style="width: auto; display: none;">
                     <div class="skin-diagnostic__circle-skinType skin-diagnostic__circle" style="cursor: default; border-color: rgb(169, 138, 130); position: static;"><img alt="loading" src="https://d3ss46vukfdtpo.cloudfront.net/static/media/analyzing-dots.bf09fa60.gif" style="width: 85%;"></div>
                     <div class="skin-diagnostic__circle-name">U-zone</div>
                  </div>
                  <div class="skin-diagnostic__circle-container pf-language pf-language-en skincare-feature-panel-pc__score" style="width: auto;">
                     <div class="active skin-diagnostic__circle-spots skin-diagnostic__circle" style="cursor: default; border-color: rgb(1, 192, 254); position: static;"><img alt="loading" src="https://d3ss46vukfdtpo.cloudfront.net/static/media/analyzing-dots.bf09fa60.gif" style="width: 85%;"></div>
                     <div class="skin-diagnostic__circle-name">Spots</div>
                  </div>
                  <div class="skin-diagnostic__circle-container pf-language pf-language-en skincare-feature-panel-pc__score" style="width: auto;">
                     <div class="skin-diagnostic__circle-wrinklesV2 skin-diagnostic__circle" style="cursor: default; border-color: rgb(112, 220, 91); position: static;"><img alt="loading" src="https://d3ss46vukfdtpo.cloudfront.net/static/media/analyzing-dots.bf09fa60.gif" style="width: 85%;"></div>
                     <div class="skin-diagnostic__circle-name">Wrinkles</div>
                  </div>
                  <div class="skin-diagnostic__circle-container pf-language pf-language-en skincare-feature-panel-pc__score" style="width: auto;">
                     <div class="skin-diagnostic__circle-texture skin-diagnostic__circle" style="cursor: default; border-color: rgb(205, 134, 242); position: static;"><img alt="loading" src="https://d3ss46vukfdtpo.cloudfront.net/static/media/analyzing-dots.bf09fa60.gif" style="width: 85%;"></div>
                     <div class="skin-diagnostic__circle-name">Texture</div>
                  </div>
                  <div class="skin-diagnostic__circle-container pf-language pf-language-en skincare-feature-panel-pc__score" style="width: auto;">
                     <div class="skin-diagnostic__circle-acne skin-diagnostic__circle" style="cursor: default; border-color: rgb(67, 165, 220); position: static;"><img alt="loading" src="https://d3ss46vukfdtpo.cloudfront.net/static/media/analyzing-dots.bf09fa60.gif" style="width: 85%;"></div>
                     <div class="skin-diagnostic__circle-name">Acne</div>
                  </div>
                  <div class="skin-diagnostic__circle-container pf-language pf-language-en skincare-feature-panel-pc__score" style="width: auto;">
                     <div class="skin-diagnostic__circle-darkCirclesV2 skin-diagnostic__circle" style="cursor: default; border-color: rgb(119, 123, 139); position: static;"><img alt="loading" src="https://d3ss46vukfdtpo.cloudfront.net/static/media/analyzing-dots.bf09fa60.gif" style="width: 85%;"></div>
                     <div class="skin-diagnostic__circle-name">Dark Circles</div>
                  </div>
                  <div class="skin-diagnostic__circle-container pf-language pf-language-en skincare-feature-panel-pc__score" style="width: auto;">
                     <div class="skin-diagnostic__circle-redness skin-diagnostic__circle" style="cursor: default; border-color: rgb(255, 46, 0); position: static;"><img alt="loading" src="https://d3ss46vukfdtpo.cloudfront.net/static/media/analyzing-dots.bf09fa60.gif" style="width: 85%;"></div>
                     <div class="skin-diagnostic__circle-name">Redness</div>
                  </div>
                  <div class="skin-diagnostic__circle-container pf-language pf-language-en skincare-feature-panel-pc__score" style="width: auto;">
                     <div class="skin-diagnostic__circle-oiliness skin-diagnostic__circle" style="cursor: default; border-color: rgb(255, 139, 12); position: static;"><img alt="loading" src="https://d3ss46vukfdtpo.cloudfront.net/static/media/analyzing-dots.bf09fa60.gif" style="width: 85%;"></div>
                     <div class="skin-diagnostic__circle-name">Oiliness</div>
                  </div>
                  <div class="skin-diagnostic__circle-container pf-language pf-language-en skincare-feature-panel-pc__score" style="width: auto;">
                     <div class="skin-diagnostic__circle-moisture skin-diagnostic__circle" style="cursor: default; border-color: rgb(35, 217, 227); position: static;"><img alt="loading" src="https://d3ss46vukfdtpo.cloudfront.net/static/media/analyzing-dots.bf09fa60.gif" style="width: 85%;"></div>
                     <div class="skin-diagnostic__circle-name">Moisture</div>
                  </div>
                  <div class="skin-diagnostic__circle-container pf-language pf-language-en skincare-feature-panel-pc__score" style="width: auto;">
                     <div class="skin-diagnostic__circle-pore skin-diagnostic__circle" style="cursor: default; border-color: rgb(139, 184, 16); position: static;"><img alt="loading" src="https://d3ss46vukfdtpo.cloudfront.net/static/media/analyzing-dots.bf09fa60.gif" style="width: 85%;"></div>
                     <div class="skin-diagnostic__circle-name">Pores</div>
                  </div>
                  <div class="skin-diagnostic__circle-container pf-language pf-language-en skincare-feature-panel-pc__score" style="width: auto;">
                     <div class="skin-diagnostic__circle-eyeBags skin-diagnostic__circle" style="cursor: default; border-color: rgb(205, 86, 117); position: static;"><img alt="loading" src="https://d3ss46vukfdtpo.cloudfront.net/static/media/analyzing-dots.bf09fa60.gif" style="width: 85%;"></div>
                     <div class="skin-diagnostic__circle-name">Eye bags</div>
                  </div>
                  <div class="skin-diagnostic__circle-container pf-language pf-language-en skincare-feature-panel-pc__score" style="width: auto;">
                     <div class="skin-diagnostic__circle-radiance skin-diagnostic__circle" style="cursor: default; border-color: rgb(170, 187, 205); position: static;"><img alt="loading" src="https://d3ss46vukfdtpo.cloudfront.net/static/media/analyzing-dots.bf09fa60.gif" style="width: 85%;"></div>
                     <div class="skin-diagnostic__circle-name">Radiance</div>
                  </div>
                  <div class="skin-diagnostic__circle-container pf-language pf-language-en skincare-feature-panel-pc__score" style="width: auto;">
                     <div class="skin-diagnostic__circle-firmness skin-diagnostic__circle" style="cursor: default; border-color: rgb(252, 133, 254); position: static;"><img alt="loading" src="https://d3ss46vukfdtpo.cloudfront.net/static/media/analyzing-dots.bf09fa60.gif" style="width: 85%;"></div>
                     <div class="skin-diagnostic__circle-name">Firmness</div>
                  </div>
                  <div class="skin-diagnostic__circle-container pf-language pf-language-en skincare-feature-panel-pc__score" style="width: auto;">
                     <div class="skin-diagnostic__circle-droopyUpperEyelid skin-diagnostic__circle" style="cursor: default; border-color: rgb(229, 69, 255); position: static;"><img alt="loading" src="https://d3ss46vukfdtpo.cloudfront.net/static/media/analyzing-dots.bf09fa60.gif" style="width: 85%;"></div>
                     <div class="skin-diagnostic__circle-name">Droopy Upper Eyelid</div>
                  </div>
                  <div class="skin-diagnostic__circle-container pf-language pf-language-en skincare-feature-panel-pc__score" style="width: auto;">
                     <div class="skin-diagnostic__circle-droopyLowerEyelid skin-diagnostic__circle" style="cursor: default; border-color: rgb(203, 46, 131); position: static;"><img alt="loading" src="https://d3ss46vukfdtpo.cloudfront.net/static/media/analyzing-dots.bf09fa60.gif" style="width: 85%;"></div>
                     <div class="skin-diagnostic__circle-name">Droopy Lower Eyelid</div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>









@includeIf('partials.global.common-footer')
@endsection
@section('script')
<script>
        // Access the camera
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(function(stream) {
                let video = document.getElementById('video');
                video.srcObject = stream;
                video.play();
                // Start automatic photo capture every 5 seconds
                setInterval(capturePhoto, 5000);
            })
            .catch(function(error) {
                console.log("Error accessing the camera: ", error);
            });
        // Function to capture a photo
        function capturePhoto() {
            let canvas = document.getElementById('canvas');
            let context = canvas.getContext('2d');
            let video = document.getElementById('video');
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            // Convert image to base64 and send it to the server
            let imageData = canvas.toDataURL('image/png');
            uploadPhoto(imageData);
        }
        // Function to upload photo to Laravel backend
        function uploadPhoto(imageData) {
            fetch('/save-photo', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Required for Laravel
                },
                body: JSON.stringify({ image: imageData })
            })
            .then(response => response.json())
            .then(data => console.log(data))
            .catch(error => console.error("Error uploading image: ", error));
        }
    </script>
@endsection