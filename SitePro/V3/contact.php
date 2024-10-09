<h1>Contact Me</h1>
<form action="#" method="POST">
    <div class="form-container">
        <div class="form-element">
            <label for="name">Votre nom</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div class="form-element">
            <label for="email">Votre adresse email</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-element">
            <label for="subject">Objet</label>
            <input type="text" id="subject" name="subject" required>
        </div>

        <div class="form-element">
            <label for="message">Message</label>
            <textarea id="message" name="message" rows="5" required></textarea>
        </div>

        <div class="form-element">
            <button type="submit">Envoyer</button>
        </div>
    </div>
</form>