var renderer = PIXI.autoDetectRenderer(1300, 850);
renderer.backgroundColor = 0x000055;
document.body.appendChild(renderer.view);
var start = new PIXI.Container();
var loading = new PIXI.Container();
var stage = new PIXI.Container();
var end = new PIXI.Container();
var loader;


setup();

function setup() {
    var texture = PIXI.Texture.fromImage('//localhost/testPixi/img/cat.png');

    var cat = new PIXI.Sprite(texture);

    cat.interactive = true;
    cat.buttonMode = true;

    cat
        .on('click', loadGame)
        .on('touchstart', loadGame);

    cat.x = 650;
    cat.y = 750 / 2;

    // cat.scale.set(3);
    start.addChild(cat);
    requestAnimationFrame( animate );


    function animate() {

        requestAnimationFrame(animate);

        renderer.render(start);
    }
}
function loadGame() {
    loader = PIXI.loader
        .add(["//localhost/testPixi/img/rectangle.png",
            "//localhost/testPixi/img/cercle.png",
            "//localhost/testPixi/img/star.png",
            "//localhost/testPixi/img/triangle.png"])
        .on('progress', loadProgressHandler)
        .load(game)
}

function loadProgressHandler() {

    var style = new PIXI.TextStyle({
        fontFamily: "Futura",
        fontSize: 64,
        fill: "white"
    });

    var text = new PIXI.Text("loading...", style);

    text.y = stage.height / 2;

    loading.addChild(text);
    requestAnimationFrame( animate );


    function animate() {

        requestAnimationFrame(animate);

        renderer.render(loading);
    }

}
function game() {

    var countForm = 0;
    createRectDraw();
    createCircleDraw();
    createTriangleDraw();
    createStarDraw();

    for (var i=1; i < 4; i++){
        var xR = 200 + Math.random() * 800;
        var yR = 300 + Math.random() * 400;
        createRectSprite(Math.floor(xR) , Math.floor(yR));
        countForm ++;

    }
    for (var i=1; i < 4; i++){
        var xC = 200 + Math.random() * 800;
        var yC = 300 + Math.random() * 400;
        createCircleSprite(Math.floor(xC) , Math.floor(yC));
        countForm ++;

    }

    for (var i=1; i < 4; i++){
        var xT = 200 + Math.random() * 800;
        var yT = 300 + Math.random() * 400;
        createTriangleSprite(Math.floor(xT) , Math.floor(yT));
        countForm ++;

    }

    for (var i=1; i < 4; i++){
        var xT = 200 + Math.random() * 800;
        var yT = 300 + Math.random() * 400;
        createStarSprite(Math.floor(xT) , Math.floor(yT));
        countForm ++;

    }

    console.log(countForm);


    function createRectDraw() {

        var rect = new PIXI.Graphics();
        rect.beginFill(0xFFAA00);
        rect.lineStyle(0);
        rect.drawRect(50, 50, 350, 150);
        rect.endFill();

        stage.addChild(rect);

    }
    function createCircleDraw() {

        var circle = new PIXI.Graphics();
        circle.beginFill(0xe74c3c);
        circle.drawCircle(550, 125, 100);
        circle.endFill();

        stage.addChild(circle);

    }

    function createTriangleDraw() {

        var triangle = new PIXI.Graphics();
        triangle.beginFill(0x4A5FB4);
        triangle.moveTo(800, 50);
        triangle.lineTo(700, 200);
        triangle.lineTo(900, 200);
        triangle.lineTo(800, 50);
        triangle.endFill();

        stage.addChild(triangle);

    }

    function createStarDraw() {

        var star = new PIXI.Graphics();
        star.beginFill(0xFFFF00);
        star.drawStar(1050, 125, 5, 100);
        star.endFill();

        stage.addChild(star);

    }
    function createRectSprite(x,y) {

        var texture = PIXI.Texture.fromImage('//localhost/testPixi/img/rectangle.png');

        var rect = new PIXI.Sprite(texture);
        rect.interactive = true;
        rect.buttonMode = true;

        rect.anchor.set(0.5);

        rect
            .on('mousedown', onDragStart)
            .on('touchstart', onDragStart)
            .on('mouseup', onDragEnd)
            .on('mouseupoutside', onDragEnd)
            .on('touchend', onDragEnd)
            .on('touchendoutside', onDragEnd)
            .on('mousemove', onDragMove)
            .on('touchmove', onDragMove);


        rect.position.x = x;
        rect.position.y = y;

        rect.test = 'rectangle';

        stage.addChild(rect);

    }
    function createCircleSprite(x,y) {

        var texture = PIXI.Texture.fromImage('//localhost/testPixi/img/cercle.png');

        var circle = new PIXI.Sprite(texture);
        circle.interactive = true;
        circle.buttonMode = true;

        circle.anchor.set(0.5);
        circle
            .on('mousedown', onDragStart)
            .on('touchstart', onDragStart)
            .on('mouseup', onDragEnd)
            .on('mouseupoutside', onDragEnd)
            .on('touchend', onDragEnd)
            .on('touchendoutside', onDragEnd)
            .on('mousemove', onDragMove)
            .on('touchmove', onDragMove);


        circle.position.x = x;
        circle.position.y = y;
        circle.test = 'circle';

        stage.addChild(circle);

    }
    function createTriangleSprite(x,y) {

        var texture = PIXI.Texture.fromImage('//localhost/testPixi/img/triangle.png');

        var triangle = new PIXI.Sprite(texture);
        triangle.interactive = true;
        triangle.buttonMode = true;

        triangle.anchor.set(0.5);

        triangle
            .on('mousedown', onDragStart)
            .on('touchstart', onDragStart)
            .on('mouseup', onDragEnd)
            .on('mouseupoutside', onDragEnd)
            .on('touchend', onDragEnd)
            .on('touchendoutside', onDragEnd)
            .on('mousemove', onDragMove)
            .on('touchmove', onDragMove);


        triangle.position.x = x;
        triangle.position.y = y;
        triangle.test = 'triangle';

        stage.addChild(triangle);

    }

    function createStarSprite(x,y) {

        var texture = PIXI.Texture.fromImage('//localhost/testPixi/img/star.png');

        var star = new PIXI.Sprite(texture);
        star.interactive = true;
        star.buttonMode = true;

        star.anchor.set(0.5);

        star
            .on('mousedown', onDragStart)
            .on('touchstart', onDragStart)
            .on('mouseup', onDragEnd)
            .on('mouseupoutside', onDragEnd)
            .on('touchend', onDragEnd)
            .on('touchendoutside', onDragEnd)
            .on('mousemove', onDragMove)
            .on('touchmove', onDragMove);


        star.position.x = x;
        star.position.y = y;
        star.test = 'star';

        stage.addChild(star);

    }


    requestAnimationFrame( animate );


    function animate() {

        requestAnimationFrame(animate);

        renderer.render(stage);
    }

    function onDragStart(event)
    {
        this.data = event.data;
        this.alpha = 0.5;
        this.dragging = true;
    }

    function checkForm(form) {
        if (form.test == 'rectangle'){
            if(form.position.x > 25 && form.position.x< 375 && form.position.y > 25 && form.position.y < 225){
                console.log('ok');
                stage.removeChild(form);
                countForm --;
            }
        }
        if (form.test == 'circle'){
            if(form.position.x > 420 && form.position.x < 580 && form.position.y > 20 && form.position.y < 200 ){
                console.log(form.position.x);
                console.log('ok');
                stage.removeChild(form);
                countForm --;
            }
        }
        if (form.test == 'triangle'){
            if(form.position.x > 675 && form.position.x < 925 && form.position.y > 20 && form.position.y < 200 ){
                console.log(form.position.x);
                console.log('ok');
                stage.removeChild(form);
                countForm --;
            }
        }
        if (form.test == 'star'){
            if(form.position.x > 925 && form.position.x < 1075 && form.position.y > 20 && form.position.y < 200 ){
                console.log(form.position.x);
                console.log('ok');
                stage.removeChild(form);
                countForm --;
            }
        }
        if(countForm == 0){
            endGame();
            console.log('fini')
        }

    }

    function onDragEnd()
    {
        this.alpha = 1;
        this.dragging = false;
        this.data = null;

        checkForm(this);
    }

    function onDragMove()
    {
        if (this.dragging)
        {
            var newPosition = this.data.getLocalPosition(this.parent);
            this.position.x = newPosition.x;
            this.position.y = newPosition.y;
        }

    }


}
function endGame() {
    var style = new PIXI.TextStyle({
        fontFamily: "Futura",
        fontSize: 64,
        fill: "white"
    });

    var text = new PIXI.Text("bien joué", style);
    text.y = stage.height / 2;
    end.addChild(text);


    requestAnimationFrame( animate );

    function animate() {

        requestAnimationFrame(animate);

        renderer.render(end);
    }

}