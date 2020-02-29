<?php return ' <div class="field">
  <label class="label" for="name">Name*</label>
  <div class="control">
    <input name="name" id="name" type="text" value="{{ old(\'name\', $testuser->name) }}" placeholder="" required class="input @error(\'name\') is-danger @enderror">
  </div>
  @error(\'name\')
    <p class="help is-danger">{{ $message }}</p>
  @enderror
</div>

 <div class="field">
  <label class="label" for="my_date">My Date</label>
  <div class="control">
    <input name="my_date" id="my_date" type="text" value="{{ old(\'my_date\', $testuser->my_date) }}" placeholder="" class="input @error(\'my_date\') is-danger @enderror">
  </div>
  @error(\'my_date\')
    <p class="help is-danger">{{ $message }}</p>
  @enderror
</div>

 <div class="field">
  <label class="label" for="email">Email*</label>
  <div class="control">
    <input name="email" id="email" type="text" value="{{ old(\'email\', $testuser->email) }}" placeholder="" required class="input @error(\'email\') is-danger @enderror">
  </div>
  @error(\'email\')
    <p class="help is-danger">{{ $message }}</p>
  @enderror
</div>

 <div class="field">
  <label class="label" for="email_verified_at">Email Verified At</label>
  <div class="control">
    <input name="email_verified_at" id="email_verified_at" type="text" value="{{ old(\'email_verified_at\', $testuser->email_verified_at) }}" placeholder="" class="input @error(\'email_verified_at\') is-danger @enderror">
  </div>
  @error(\'email_verified_at\')
    <p class="help is-danger">{{ $message }}</p>
  @enderror
</div>

 <div class="field">
  <label class="label" for="password">Password*</label>
  <div class="control">
    <input name="password" id="password" type="text" value="{{ old(\'password\', $testuser->password) }}" placeholder="" required class="input @error(\'password\') is-danger @enderror">
  </div>
  @error(\'password\')
    <p class="help is-danger">{{ $message }}</p>
  @enderror
</div>

<div class="field">
  <div class="control">
    <label class="checkbox">
      <input type="checkbox" name="attending" id="attending" value=1  @if( old(\'attending\', $testuser->attending) ) checked  @endif required>
      Attending*
    </label>
  </div>
</div><div class="field">
  <label class="label" for="description">Description*</label>
  <div class="control">
    <textarea name="description" id="description" placeholder="" required class="textarea @error(\'description\') is-danger @enderror">
      {{ old(\'description\',$testuser->description) }}
    </textarea>
  </div>
  @error(\'description\')
    <p class="help is-danger">{{ $message }}</p>
  @enderror
</div> <div class="field">
  <label class="label" for="votes">Votes*</label>
  <div class="control">
    <input name="votes" id="votes" type="text" value="{{ old(\'votes\', $testuser->votes) }}" placeholder="" required class="input @error(\'votes\') is-danger @enderror">
  </div>
  @error(\'votes\')
    <p class="help is-danger">{{ $message }}</p>
  @enderror
</div>

<div class="field">
  <label class="label" for="plan_description">Plan Description</label>
  <div class="control">
    <textarea name="plan_description" id="plan_description" placeholder="" class="textarea @error(\'plan_description\') is-danger @enderror">
      {{ old(\'plan_description\',$testuser->plan_description) }}
    </textarea>
  </div>
  @error(\'plan_description\')
    <p class="help is-danger">{{ $message }}</p>
  @enderror
</div> <div class="field">
  <label class="label" for="remember_token">Remember Token</label>
  <div class="control">
    <input name="remember_token" id="remember_token" type="text" value="{{ old(\'remember_token\', $testuser->remember_token) }}" placeholder="" class="input @error(\'remember_token\') is-danger @enderror">
  </div>
  @error(\'remember_token\')
    <p class="help is-danger">{{ $message }}</p>
  @enderror
</div>


<div class="field">
  <div class="control">
    <button class="button is-link">Submit</button>
  </div>
</div>';
