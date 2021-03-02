<div class="field">
    <label class="label">Title</label>
    <div class="control">
        <input type="text" name="title" value="{{ old('title') }}" class="input" placeholder="Title" minlength="5" maxlength="100" required />
    </div>
</div>

<div class="field">
    <label class="label">Content</label>
    <div class="control">
        <textarea name="content" class="textarea" placeholder="Content" minlength="5" maxlength="2000" required rows="10">{{ old('content') }}</textarea>
    </div>
</div>

<div class="field">
    <label class="label">Category</label>
    <div class="control">
        <div class="select">
            <select name="category" required>
                @if (isset($post))
                    <option value="" disabled selected>Select category</option>
                    <option value="html" {{ $post->category === 'html' ? 'selected' : null }}>HTML</option>
                    <option value="css" {{ $post->category === 'css' ? 'selected' : null }}>CSS</option>
                    <option value="javascript" {{ $post->category === 'javascript' ? 'selected' : null }}>JavaScript</option>
                    <option value="php" {{ $post->category === 'php' ? 'selected' : null }}>PHP</option>
                @else
                    <option value="" disabled selected>Select category</option>
                    <option value="html" {{ old('category') === 'html' ? 'selected' : null }}>HTML</option>
                    <option value="css" {{ old('category') === 'css' ? 'selected' : null }}>CSS</option>
                    <option value="javascript" {{ old('category') === 'javascript' ? 'selected' : null }}>JavaScript</option>
                    <option value="php" {{ old('category') === 'php' ? 'selected' : null }}>PHP</option>
                @endif

            </select>
        </div>
    </div>
</div>

<div class="file">
    <label class="file-label">
        <input class="file-input" type="file" name="user_file">
        <span class="file-cta">
      <span class="file-icon">
        <i class="fas fa-upload"></i>
      </span>
      <span class="file-label">
        Choose a file…
      </span>
    </span>
    </label>
</div>
<br>

<div class="field">
    <div class="control">
        <button type="submit" class="button is-link is-outlined">Publish</button>
    </div>
</div>