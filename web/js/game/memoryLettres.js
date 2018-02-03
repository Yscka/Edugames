var renderer = PIXI.autoDetectRenderer(1300,900);
renderer.backgroundColor = 0x888888;
var stage = new PIXI.Container();
var end = new PIXI.Container();
var start = new PIXI.Container();
var url= '//192.168.8.150/Edugames/web/js/game/img/';

document.body.appendChild(renderer.view);
setup();
function setup() {
    var texture = PIXI.Texture.fromImage(url+'/cat.png');

    var cat = new PIXI.Sprite(texture);

    cat.interactive = true;
    cat.buttonMode = true;

    cat
        .on('click', game)
        .on('touchstart', game);

    cat.x = 650;
    cat.y = renderer.height / 2;

    // cat.scale.set(3);
    start.addChild(cat);
    requestAnimationFrame( animate );


    function animate() {

        requestAnimationFrame(animate);

        renderer.render(start);
    }
}
function game() {
    var firstTile=null;
    var secondTile=null;
    var canPick=true;
    var complete = 0;
    var count = 6;
    var style;
    var tab = Array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
    var content = Array();
  /*  for( var i =0; i<tab.length;i++){
        var candidate = tab[i];
        content.push(candidate,candidate);
    }*/
    while (content.length<12){
        var i = Math.floor(Math.random()*tab.length);
        var candidate = tab[i];
        console.log(i +": " + tab[i] +": "+ candidate);
        content.push(candidate,candidate);
        tab.splice(i,1)
        }


    for(var i=0;i<24;i++){
        var from = Math.floor(Math.random()*12);
        var to = Math.floor(Math.random()*12);
        var tmp = content[from];
        content[from]=content[to];
        content[to]=tmp;
    }
/*console.log(content);
console.log(tab);*/

    for (var i = 0; i < 4; i++) {
        for (var j = 0; j < 3; j++) {

            var tiles = new PIXI.Graphics();

            style = new PIXI.TextStyle({
                fontFamily: "Arial",
                fontSize: 130,
                align: 'center',
                fill: 0xffffff
            });
            var text = new PIXI.Text(content[i*3+j],style);
            tiles.theVal= content[i*3+j];
            tiles.beginFill(0xffffff);
            tiles.drawRect(0, 0, 200, 200);
            text.x = 50;
            text.y = 25;
            tiles.addChild(text);
            tiles.endFill();
            tiles.position.x = 170 + i * 250;
            tiles.position.y = 100 + j * 250;
            tiles.interactive = true;
            tiles.buttonMode = true;


            tiles
            //.on('mousedown', onTilesClick)
                .on('mousedown', onTilesClick)
                .on('touchstart', onTilesClick);

            stage.addChild(tiles);


        }

    }


    requestAnimationFrame(animate);

    function animate() {

        requestAnimationFrame(animate);

        renderer.render(stage);
    }

    function onTilesClick() {
        //console.log(this.theVal)
        if(canPick) {
            // is the tile already selected?
            if(!this.isSelected){
                // set the tile to selected
                this.isSelected = true;
                // show the tile
                this.tint = 0x5F9EA0;
                this.alpha = 1;
                // is it the first tile we uncover?
                if(firstTile==null){
                    firstTile=this;
                }
                // this is the second tile
                else{
                    secondTile=this;
                    // can't pick anymore
                    canPick=false;
                    // did we pick the same tiles?
                    if(firstTile.theVal===secondTile.theVal){
                        // wait a second then remove the tiles and make the player able to pick again
                        setTimeout(function(){
                            stage.removeChild(firstTile);
                            stage.removeChild(secondTile);
                            complete += 16.666666667;
                            count -= 1;
                            completed();
                            if (count === 0){
                                endGame();
                            }else {
                                firstTile = null;
                                secondTile = null;
                                canPick = true;
                            }
                        },1000);
                    }
                    // we picked different tiles
                    else{
                        // wait a second then cover the tiles and make the player able to pick again
                        setTimeout(function(){
                            firstTile.isSelected=false;
                            secondTile.isSelected=false;
                            firstTile.tint = 0xffffff;
                            secondTile.tint = 0xffffff;

                            firstTile=null;
                            secondTile=null;
                            canPick=true;
                        },1000);
                    }
                }
            }
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

