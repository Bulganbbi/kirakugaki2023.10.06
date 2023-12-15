<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Paint App</title>
  <style>
    canvas {
      border: 1px solid #000;
    }
  </style>
</head>
<body>
  <canvas id="paintCanvas" width="800" height="600"></canvas>
  <div>
    <label for="penSize">Pen Size:</label>
    <input type="range" id="penSize" min="1" max="10" value="5">
    <input type="color" id="colorPicker" value="#000000">
  </div>
  <div>
    <button id="penTool">Pen</button>
    <button id="eraserTool">Eraser</button>
    <button id="clearCanvas">Clear</button>
    <button id="saveCanvas">Save</button>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const canvas = document.getElementById("paintCanvas");
      const context = canvas.getContext("2d");

      let isDrawing = false;
      let isEraser = false;
      let penSize = 5;

      function startDrawing(e) {
        isDrawing = true;
        draw(e);
      }

      function stopDrawing() {
        isDrawing = false;
        context.beginPath();
      }

      function draw(e) {
        if (!isDrawing) return;

        const x = e.clientX || e.touches[0].clientX;
        const y = e.clientY || e.touches[0].clientY;

        context.lineWidth = penSize;
        context.lineCap = "round";

        if (isEraser) {
          context.globalCompositeOperation = "destination-out";
          context.strokeStyle = "rgba(255,255,255,1)";
        } else {
          context.globalCompositeOperation = "source-over";
          context.strokeStyle = document.getElementById("colorPicker").value;
        }

        context.lineTo(x, y);
        context.stroke();
        context.beginPath();
        context.moveTo(x, y);
      }

      function toggleEraser() {
        isEraser = !isEraser;
        document.getElementById("penTool").disabled = isEraser;
        document.getElementById("eraserTool").disabled = !isEraser;
      }

      function updatePenSize() {
        penSize = document.getElementById("penSize").value;
      }

      function updateColor() {
        if (!isEraser) {
          context.strokeStyle = document.getElementById("colorPicker").value;
        }
      }

      function clearCanvas() {
        context.clearRect(0, 0, canvas.width, canvas.height);
      }

      function saveCanvas() {
        const dataUrl = canvas.toDataURL();
        const a = document.createElement("a");
        a.href = dataUrl;
        a.download = "painting.png";
        a.click();
      }

      document.getElementById("penTool").addEventListener("click", function () {
        isEraser = false;
        document.getElementById("penTool").disabled = true;
        document.getElementById("eraserTool").disabled = false;
      });

      document.getElementById("eraserTool").addEventListener("click", function () {
        isEraser = true;
        document.getElementById("penTool").disabled = false;
        document.getElementById("eraserTool").disabled = true;
      });

      document.getElementById("penSize").addEventListener("input", updatePenSize);
      document.getElementById("colorPicker").addEventListener("input", updateColor);
      document.getElementById("clearCanvas").addEventListener("click", clearCanvas);
      document.getElementById("saveCanvas").addEventListener("click", saveCanvas);

      canvas.addEventListener("mousedown", startDrawing);
      canvas.addEventListener("mouseup", stopDrawing);
      canvas.addEventListener("mousemove", draw);

      canvas.addEventListener("touchstart", startDrawing);
      canvas.addEventListener("touchend", stopDrawing);
      canvas.addEventListener("touchmove", draw);
    });
  </script>
</body>
</html>
