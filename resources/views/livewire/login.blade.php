<div>
    <form wire:submit="Login" class="shadow-lg p-3 roundered bg-white animate__animated animate__bounce">
        @csrf
        <h3 class="text-center text-dark">Connectez-vous ici!</h3>
        <br>
        <span class="text-red">{{$generalError}}</span>

        <div class="form-group">
            <span class="text-red">{{$account_error}}</span>
            <input type="text" wire:model="account" name="account" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Votre identifiant ....">
        </div>
        <br>
        <div class="form-group">
            <span class="text-red">{{$password_error}}</span>
            <input type="password" wire:model="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <br>
        <button type="submit" class="btn bg-dark w-100">SE CONNECTER</button>

        <div class="">
            <a href="/demande-reinitialisation" class="text-red" style="text-decoration: none;">Mot de passe oublié!?</a>
        </div>
    </form>
</div>