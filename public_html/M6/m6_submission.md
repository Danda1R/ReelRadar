<table><tr><td> <em>Assignment: </em> HW HTML5 Canvas Game</td></tr>
<tr><td> <em>Student: </em> Rishik Danda (rrd42)</td></tr>
<tr><td> <em>Generated: </em> 11/12/2023 7:43:54 PM</td></tr>
<tr><td> <em>Grading Link: </em> <a rel="noreferrer noopener" href="https://learn.ethereallab.app/homework/IT202-007-F23/hw-html5-canvas-game/grade/rrd42" target="_blank">Grading</a></td></tr></table>
<table><tr><td> <em>Instructions: </em> <ol><li>Create a branch for this assignment called&nbsp;<em>M6-HTML5-Canvas</em></li><li>Pick a base HTML5 game from&nbsp;<a href="https://bencentra.com/2017-07-11-basic-html5-canvas-games.html">https://bencentra.com/2017-07-11-basic-html5-canvas-games.html</a></li><li>Create a folder inside public_html called&nbsp;<em>M6</em></li><li>Create an html5.html file in your M6 folder (do not put it in Project even if you're doing arcade)</li><li>Copy one of the base games (from the above link)</li><li>Add/Commit the baseline of the game you'll mod for this assignment&nbsp;<em>(Do this before you start any mods/changes)</em></li><li>Make two significant changes<ol><li>Static changes like hard-coded colors/values will not count at all (i.e., changing shapes/colors/values that are globally defined and set only once.</li><li>Direct copies of my class example changes will not be accepted (i.e., just having an AI player for pong, rotating canvas, or multi-ball unless you make a significant tweak to it)</li><li>Significant changes are things that change with game logic or modify how the game works. Static changes like hard-coded colors/values will not count at all (i.e., changing shapes/colors/values that are globally defined and set only once). You may however change such values through game logic during runtime. (i.e., when points are scored, boundaries are hit, some action occurs, etc)</li></ol></li><li>Evidence/Screenshots<ol><li>As best as you can, gather evidence for your first significant change and fill in the deliverable items below.</li><li>As best as you can, gather evidence for your significant change and fill in the deliverable items below.</li><li>Remember to include your ucid/date as comments in any screenshots that have code</li><li>Ensure your screenshots load and are visible from the md file in step 9</li></ol></li><li>In the M6 folder create a new file called m6_submission.md</li><li>Save your below responses, generate the markdown, and paste the output to this file</li><li>Add/commit/push all related files as necessary</li><li>Merge your pull request once you're satisfied with the .md file and the canvas game mods</li><li>Create a new pull request from dev to prod and merge it</li><li>Locally checkout dev and pull the merged changes from step 12</li></ol><p>Each missed or failed to follow instruction is eligible for -0.25 from the final grade</p></td></tr></table>
<table><tr><td> <em>Deliverable 1: </em> Game Info </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> What game did you pick to edit/modify?</td></tr>
<tr><td> <em>Response:</em> <p>I chose Pong.<br></p><br></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add the direct link to the html5.html file from Heroku Prod (i.e., https://mt85-prod.herokuapp.com/M6/html5.html)</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://it202-rrd42-prod-2f24ad61807f.herokuapp.com/M6/html5.html">https://it202-rrd42-prod-2f24ad61807f.herokuapp.com/M6/html5.html</a> </td></tr>
<tr><td> <em>Sub-Task 3: </em> Add the pull request link for this assignment from M6-HTML5-Canvas to dev</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/Danda1R/rrd42-IT202-007/pull/45">https://github.com/Danda1R/rrd42-IT202-007/pull/45</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 2: </em> Significant Change #1 </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Describe your change/modification</td></tr>
<tr><td> <em>Response:</em> <p>Everything the ball is hit by a player, it changes color and gets<br>slightly bigger. When one of the players scores, the ball changes color again<br>and the ball is reset to the normal size.<br></p><br></td></tr>
<tr><td> <em>Sub-Task 2: </em> Screenshot of the change while playing (try your best as some changes may be nearly impossible to capture)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-11-13T00.20.52Screenshot%202023-11-12%20at%207.18.24%E2%80%AFPM.png.webp?alt=media&token=49686950-6113-4a63-a945-703e64a30514"/></td></tr>
<tr><td> <em>Caption:</em> <p>The color of the ball is initially purple. The yellow box is blocking<br>my bookmarks<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-11-13T00.22.28Screenshot%202023-11-12%20at%207.18.29%E2%80%AFPM.png.webp?alt=media&token=4e784a0b-bd8c-498b-adbc-f7e38c6c5b93"/></td></tr>
<tr><td> <em>Caption:</em> <p>After being hit, the ball has changed to grey.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-11-13T00.23.14Screenshot%202023-11-12%20at%207.19.31%E2%80%AFPM.png.webp?alt=media&token=2a316797-f8ce-4105-a384-4f950b31b61f"/></td></tr>
<tr><td> <em>Caption:</em> <p>The green ball is about 1.5 times bigger than normal after the round<br>has lasted 40 seconds. <br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Screenshot of the relevant lines of code that implement your change (make sure your ucid and the date are shown in comments) In the caption briefly describe/explain how the code snippet works.</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-11-13T00.26.55Screenshot%202023-11-12%20at%207.25.22%E2%80%AFPM.png.webp?alt=media&token=5572881a-bbf0-4371-90b7-2ab859befcf3"/></td></tr>
<tr><td> <em>Caption:</em> <p>Added ball.c=&#39;#000000&#39;. replace(/0/g, function () { return (~~(Math. random() * 16)). toString (16);<br>｝), which generates a random hex code every time the ball is reset.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-11-13T00.29.18Screenshot%202023-11-12%20at%207.25.28%E2%80%AFPM.png.webp?alt=media&token=8d5986c5-88f3-4cff-8225-41d48173d21e"/></td></tr>
<tr><td> <em>Caption:</em> <p>Added ball.c=&#39;#000000&#39;. replace(/0/g, function () { return (~~(Math. random() * 16)). toString (16);<br>｝), which generates a random hex code every time the ball is hit.<br>Also<br>added ball.w += 0.5 and ball.h += 0.5 to slightly increase the size<br>of the ball every time if gets hit.<br></p>
</td></tr>
</table></td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 3: </em> Significant Change #2 </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Describe your change/modification</td></tr>
<tr><td> <em>Response:</em> <p>Allow the paddles to move left and right. Player one can move the<br>paddles left and right with the A and D keys. Player two can<br>move the paddles left and right with the left and right arrow keys.<br></p><br></td></tr>
<tr><td> <em>Sub-Task 2: </em> Screenshot of the change while playing (try your best as some changes may be nearly impossible to capture)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-11-13T00.35.15Screenshot%202023-11-12%20at%207.34.42%E2%80%AFPM.png.webp?alt=media&token=5f167b7a-0d71-407b-b6df-5ab8581dfee0"/></td></tr>
<tr><td> <em>Caption:</em> <p>The left paddle is being moved to the right and the right paddle<br>is being moved to the left<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-11-13T00.36.00Screenshot%202023-11-12%20at%207.34.46%E2%80%AFPM.png.webp?alt=media&token=0bd63032-fdba-42fd-b8a3-b4fe5a15c076"/></td></tr>
<tr><td> <em>Caption:</em> <p>Another example where the ball is bouncing very quickly between the two paddles<br>being very close to each other<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Screenshot of the relevant lines of code that implement your change (make sure your ucid and the date are shown in comments) In the caption briefly describe/explain how the code snippet works.</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-11-13T00.36.41Screenshot%202023-11-12%20at%207.25.02%E2%80%AFPM.png.webp?alt=media&token=22205198-1e89-46a0-9359-a7fc10404bd8"/></td></tr>
<tr><td> <em>Caption:</em> <p>Added key codes for A, D, Left and Right and added it to<br>the key array<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-11-13T00.38.18Screenshot%202023-11-12%20at%207.25.41%E2%80%AFPM.png.webp?alt=media&token=8780e7e4-cd2b-4376-8f81-43058aeecb4e"/></td></tr>
<tr><td> <em>Caption:</em> <p>Added A, D, Left and Right for the keydown EventListener<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-11-13T00.38.49Screenshot%202023-11-12%20at%207.25.48%E2%80%AFPM.png.webp?alt=media&token=5a5057b4-5dd8-421c-a8fb-0982cf1e99f8"/></td></tr>
<tr><td> <em>Caption:</em> <p>Added A, D, Left and Right for the keyup EventListener<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-11-13T00.39.23Screenshot%202023-11-12%20at%207.25.54%E2%80%AFPM.png.webp?alt=media&token=98f6b726-0d0f-44d7-9b56-66711c8cb322"/></td></tr>
<tr><td> <em>Caption:</em> <p>Added instructions to the home page.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-11-13T00.40.05Screenshot%202023-11-12%20at%207.26.06%E2%80%AFPM.png.webp?alt=media&token=9c043259-7421-4e6a-ab7d-a53f1687b9c1"/></td></tr>
<tr><td> <em>Caption:</em> <p>Added controls for the A, D, Left and Right keys<br></p>
</td></tr>
</table></td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 4: </em> Discuss </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Talk about what you learned during this assignment and the related HTML5 Canvas readings (at least a few sentences for full credit)</td></tr>
<tr><td> <em>Response:</em> <p>I have learned a lot about drawing on an HTML page and how<br>to continuously change and build upon the original image with new frames, drawings,<br>and text. I also learned about the Game loop and how most games<br>consist of a very complicated game loop to keep it running until the<br>user stops playing. Finally, I did not realize that HTML would need an<br>Event listener for KeyUp and KeyDown, but now I realize how important it<br>truly is.<br></p><br></td></tr>
</table></td></tr>
<table><tr><td><em>Grading Link: </em><a rel="noreferrer noopener" href="https://learn.ethereallab.app/homework/IT202-007-F23/hw-html5-canvas-game/grade/rrd42" target="_blank">Grading</a></td></tr></table>
