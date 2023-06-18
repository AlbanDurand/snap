<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snap card game - Configuration</title>
    <link rel="stylesheet" href="screen.css">
</head>
<body>
    <div class="page">
        <div class="column configuration">
            <div class="column-inner">
                <h1>Snap card game</h1>
                <h2>Configuration</h2>

                <br>
                <br>

                <form action="demo.php" method="post" class="js-configuration-form">
                    <label for="numberOfPlayers">Number of players</label>

                    <br>

                    <select id="numberOfPlayers" name="numberOfPlayers">
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>

                    <br>
                    <br>

                    <label for="numberOfDecks">Number of decks</label>

                    <br>

                    <select id="numberOfDecks" name="numberOfDecks">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>

                    <br>
                    <br>

                    <label for="limitOfRounds">Limit of rounds</label>

                    <br>

                    <input type="number" id="limitOfRounds" name="limitOfRounds" value="50">

                    <br>
                    <br>

                    <label for="matchingCardsCondition">How cards should match?</label>

                    <br>

                    <select id="matchingCardsCondition" name="matchingCardsCondition">
                        <option value="face">By face</option>
                        <option value="suit">By suit</option>
                        <option value="color">By color</option>
                        <option value="suit_and_face">By suit and face</option>
                        <option value="suit_or_face">Either by suit or face</option>
                        <option value="face_and_color">By face and color</option>
                        <option value="face_or_color">Either by face or color</option>
                        <option value="suit_or_color">Either by suit or color</option>
                    </select>

                    <br>
                    <br>

                    <label for="drawCardFromPlayerHandStrategy">
                        How players should draw cards from their hand?
                    </label>

                    <br>

                    <select id="drawCardFromPlayerHandStrategy" name="drawCardFromPlayerHandStrategy">
                        <option value="top">Draw from top</option>
                        <option value="bottom">Draw from bottom</option>
                        <option value="random">Draw Randomly</option>
                    </select>

                    <br>
                    <br>

                    <label for="addCardsToPlayerHandStrategy">
                        How players should add won cards to their hand?
                    </label>

                    <br>

                    <select id="addCardsToPlayerHandStrategy" name="addCardsToPlayerHandStrategy">
                        <option value="top">Add to top</option>
                        <option value="bottom">Add to bottom</option>
                        <option value="random">Add randomly</option>
                    </select>

                    <br>
                    <br>

                    <button type="submit">New game</button>
                </form>

            </div>
        </div>

        <div class="column results js-results">
            <div class="column-inner js-results-logs">
                <div>Results will be displayed here...</div>
            </div>
        </div>
    </div>

    <script src="index.js"></script>
</body>
</html>