    <!DOCTYPE html>
    <html lang="en">

    <body>
    <h3>Bàn cờ kích thước {{ $n }} x {{ $n }}</h3>
    
    <div class="chess-broad">
        @for ($i=0; $i < $n; $i++)
            <div class="row">
                @for ($j=0; $j < $n; $j++)
                    <div class="square {{ ($i + $j) % 2 == 0 ? 'white' : 'black' }}"> </div>
                @endfor
            </div>  
            @endfor
    </div>
    <a href="{{ route('home') }}">Về trang chủ</a>
    </body>
    <head>
    <style>
        .chess-broad {
            display: flex;
            flex-direction: column;
            width: fit-content;
            border: 2px solid black;
        }

        .row {
            display: flex;
        }

        .square {
            width: 50px;
            height: 50px;
        }

        .white {
            background-color: white;
        }

        .black {
            background-color: black;
        }
    </style>
    </head>
    </html>
    
