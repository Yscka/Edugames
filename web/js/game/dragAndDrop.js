var renderer = PIXI.autoDetectRenderer();
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

    cat.x = renderer.width /2;
    cat.y = renderer.height / 2;
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
    var complete = 0;
    var countForm = 0;
    createRectDraw();
    createCircleDraw();
    createTriangleDraw();
    createStarDraw();

    for (var i=1; i < 4; i++){
        var xR =  renderer.width/6.5 + Math.random() * renderer.width/1.6;
        var yR = renderer.height/3 + Math.random() * renderer.height/2;
        createRectSprite(Math.floor(xR) , Math.floor(yR));
        countForm ++;

    }
    for (var i=1; i < 4; i++){
        var xC = renderer.width/6.5 + Math.random() * renderer.width/1.6;
        var yC = renderer.height/3 + Math.random() * renderer.height/2;
        createCircleSprite(Math.floor(xC) , Math.floor(yC));
        countForm ++;

    }

    for (var i=1; i < 4; i++){
        var xT = renderer.width/6.5 + Math.random() * renderer.width/1.6;
        var yT = renderer.height/3 + Math.random() * renderer.height/2;
        createTriangleSprite(Math.floor(xT) , Math.floor(yT));
        countForm ++;

    }

    for (var i=1; i < 4; i++){
        var xT = renderer.width/6.5 + Math.random() * renderer.width/1.6;
        var yT = renderer.height/3 + Math.random() * renderer.height/2;
        createStarSprite(Math.floor(xT) , Math.floor(yT));
        countForm ++;

    }

    console.log(countForm);


    function createRectDraw() {

        var rect = new PIXI.Graphics();
        rect.beginFill(0xFFAA00);
        rect.lineStyle(0);
        rect.drawRect(renderer.width/26, renderer.height/18, renderer.width/3.7 , renderer.height/6);
        rect.endFill();

        stage.addChild(rect);

    }
    function createCircleDraw() {

        var circle = new PIXI.Graphics();
        circle.beginFill(0xe74c3c);
        circle.drawCircle(renderer.width/2.3, renderer.height/6.3, 60);
        circle.endFill();

        stage.addChild(circle);

    }

    function createTriangleDraw() {

        var triangle = new PIXI.Graphics();
        triangle.beginFill(0x4A5FB4);
        triangle.moveTo(renderer.width/1.6, renderer.height/14);
        triangle.lineTo(renderer.width/1.8, renderer.height/4.5);
        triangle.lineTo(renderer.width/1.43, renderer.height/4.5);
        triangle.lineTo(renderer.width/1.6, renderer.height/14);
        triangle.endFill();

        stage.addChild(triangle);

    }

    function createStarDraw() {

        var star = new PIXI.Graphics();
        star.beginFill(0xFFFF00);
        star.drawStar(renderer.width/1.23, renderer.height/7, 5, renderer.width/12.5);
        star.endFill();

        stage.addChild(star);

    }
    function createRectSprite(x,y) {

        var texture = PIXI.Texture.fromImage('//localhost/testPixi/img/rectangle.png');

        var rect = new PIXI.Sprite(texture);
        rect.interactive = true;
        rect.buttonMode = true;
        rect.scale.set(0.6);
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
            if(form.position.x > renderer.width/26 && form.position.x < renderer.width/3.7 && form.position.y > renderer.height/45 && form.position.y < renderer.height/4.5){
               // console.log('ok');
                stage.removeChild(form);
                countForm --;
                complete += 8.33;
                completed();
            }
        }
        if (form.test == 'circle'){
            if(form.position.x > renderer.width/3.1 && form.position.x < renderer.width/2.1 && form.position.y > renderer.height/45 && form.position.y < renderer.height/4.5 ){
                //console.log(form.position.x);
                //console.log('ok');
                stage.removeChild(form);
                countForm --;
                complete += 8.33;
                completed();
            }
        }
        if (form.test == 'triangle'){
            if(form.position.x > renderer.width/1.9 && form.position.x < renderer.width/1.4 && form.position.y > renderer.height/45 && form.position.y < renderer.height/4.5 ){
               // console.log(form.position.x);
                //console.log('ok');
                stage.removeChild(form);
                countForm --;
                complete += 8.33;
                completed();
            }
        }
        if (form.test == 'star'){
            if(form.position.x > renderer.width/1.4 && form.position.x < renderer.width/1.15 && form.position.y > renderer.height/45 && form.position.y < renderer.height/4.5 ){
                //console.log(form.position.x);
                //console.log('ok');
                stage.removeChild(form);
                countForm --;
                complete += 8.33;
                completed();
            }
        }
        if(countForm == 0){
            //complete = 100;
            completed();
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
    function completed() {
        $.ajax({
            type:'POST',
            data: {complete:complete},
            url: "",
            success:function(data){
            },
            error:function(){
                console.log('attention');
            }
        });
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







