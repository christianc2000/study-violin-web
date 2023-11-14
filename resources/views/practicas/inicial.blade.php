<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div>Postura inicial Violín</div>
    <button type="button" onclick="init()">Start</button>
    <div><canvas id="canvas"></canvas></div>

    <div id="label-container"></div>

    <div><canvas id="canvas2"></canvas></div>
    <input type='file' id='imageUpload' />
    <button type="button" onclick="iniciar()">Analizar</button>
    <div id="label-container2"></div>

    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@1.3.1/dist/tf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@teachablemachine/pose@0.8/dist/teachablemachine-pose.min.js"></script>
    <script type="text/javascript">
        // More API functions here:
        // https://github.com/googlecreativelab/teachablemachine-community/tree/master/libraries/pose

        // the link to your model provided by Teachable Machine export panel
        const URL = "./pose_inicial_violin/";
        let model, webcam, ctx, labelContainer, maxPredictions;

        async function init() {
            const modelURL = URL + "model.json";
            const metadataURL = URL + "metadata.json";

            // load the model and metadata
            // Refer to tmImage.loadFromFiles() in the API to support files from a file picker
            // Note: the pose library adds a tmPose object to your window (window.tmPose)
            model = await tmPose.load(modelURL, metadataURL);
            maxPredictions = model.getTotalClasses();

            // Convenience function to setup a webcam
            const size = 600;
            const flip = true; // whether to flip the webcam
            webcam = new tmPose.Webcam(size, size, flip); // width, height, flip
            await webcam.setup(); // request access to the webcam
            await webcam.play();
            window.requestAnimationFrame(loop);

            // append/get elements to the DOM
            const canvas = document.getElementById("canvas");
            canvas.width = size;
            canvas.height = size;
            ctx = canvas.getContext("2d");
            labelContainer = document.getElementById("label-container");
            for (let i = 0; i < maxPredictions; i++) { // and class labels
                labelContainer.appendChild(document.createElement("div"));
            }
        }

        async function loop(timestamp) {
            webcam.update(); // update the webcam frame
            await predict();
            window.requestAnimationFrame(loop);
        }

        async function predict() {
            // Prediction #1: run input through posenet
            // estimatePose can take in an image, video or canvas html element
            const {
                pose,
                posenetOutput
            } = await model.estimatePose(webcam.canvas);
            // Prediction 2: run input through teachable machine classification model
            const prediction = await model.predict(posenetOutput);

            for (let i = 0; i < maxPredictions; i++) {
                const classPrediction =
                    prediction[i].className + ": " + prediction[i].probability.toFixed(2);
                labelContainer.childNodes[i].innerHTML = classPrediction;
            }

            // finally draw the poses
            drawPose(pose);
        }

        function drawPose(pose) {
            if (webcam.canvas) {
                ctx.drawImage(webcam.canvas, 0, 0);
                // draw the keypoints and skeleton
                if (pose) {
                    const minPartConfidence = 0.5;
                    tmPose.drawKeypoints(pose.keypoints, minPartConfidence, ctx);
                    tmPose.drawSkeleton(pose.keypoints, minPartConfidence, ctx);
                }
            }
        }

        //FUNCIONES AÑADIDAS
        // Obtén una referencia al elemento canvas y al input de tipo archivo
        const canvas = document.getElementById("canvas2");
        const imageUpload = document.getElementById("imageUpload");

        // Añade un evento de cambio al input de archivo

        imageUpload.addEventListener("change", function(e) {
            const file = e.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(event) {
                    const img = new Image();
                    img.onload = function() {
                        const canvasWidth = 500; // Ancho deseado para el canvas
                        const canvasHeight = 500; // Alto deseado para el canvas

                        // Establece el ancho y alto del canvas
                        canvas.width = canvasWidth;
                        canvas.height = canvasHeight;

                        // Obtiene el contexto 2D del canvas
                        const ctx = canvas.getContext("2d");

                        // Dibuja la imagen en el canvas con el tamaño deseado
                        ctx.drawImage(img, 0, 0, img.width, img.height, 0, 0, canvasWidth, canvasHeight);
                    };

                    // Carga la imagen seleccionada
                    img.src = event.target.result;
                };

                // Lee el archivo como una URL de datos
                reader.readAsDataURL(file);
            }
        });


        async function iniciar() {
            const modelURL = URL + "model.json";
            const metadataURL = URL + "metadata.json";

            // load the model and metadata
            model = await tmPose.load(modelURL, metadataURL);
            maxPredictions = model.getTotalClasses();

            // append/get elements to the DOM
            const canvas2 = document.getElementById("canvas2");
            ctx = canvas2.getContext("2d");




            labelContainer = document.getElementById("label-container2");
            for (let i = 0; i < maxPredictions; i++) {
                // and class labels
                labelContainer.appendChild(document.createElement("div"));
            }

            // You can load an image here and predict, or you can add an event listener to an input field
            // that allows users to upload an image.
            predict2(); // Perform initial prediction.
        }

        async function predict2() {
            // Get the image data from canvas2
            const imageData = ctx.getImageData(0, 0, canvas2.width, canvas2.height).data;

            const {
                pose,
                posenetOutput
            } = await model.estimatePose(canvas2);
            // // Prediction: run input through the teachable machine classification model
            const prediction = await model.predict(posenetOutput);
            console.log(prediction);
            for (let i = 0; i < maxPredictions; i++) {
                const classPrediction =
                    prediction[i].className + ": " + prediction[i].probability.toFixed(2);
                labelContainer.childNodes[i].innerHTML = classPrediction;
            }
            console.log("predict2");
            drawPose2(pose);
        }

        function drawPose2(pose) {
            const ctx2 = canvas2.getContext('2d'); // Obtén el contexto 2D de canvas2

            ctx2.drawImage(canvas2, 0, 0); // Copia la imagen original a canvas2

            // Dibuja la pose en canvas2
            if (pose) {
                const minPartConfidence = 0.5;
                tmPose.drawKeypoints(pose.keypoints, minPartConfidence, ctx2);
                tmPose.drawSkeleton(pose.keypoints, minPartConfidence, ctx2);
            }
        }

        // Event listener for when an image is uploaded
        //const imageUpload = document.getElementById("imageUpload");
        // imageUpload.addEventListener("change", function(e) {
        //     const file = e.target.files[0];
        //     if (file) {
        //         const img = new Image();

        //         img.onload = function() {
        //             // Set the width and height of canvas2 to match the image dimensions
        //             canvas2.width = img.width;
        //             canvas2.height = img.height;
        //             ctx.drawImage(img, 0, 0);
        //             predict(); // Perform prediction on the uploaded image.
        //         };

        //         img.src = URL.createObjectURL(file);
        //     }
        // });
    </script>

</body>

</html>
