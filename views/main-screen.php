<div class="wrap">

<h1><?php _e('Search images', 'we-search-replace-images') ?></h1>

<section>
    <header>
        <div id="authors-list">
            <select>
                <option v-for="(value, name) in list">
                    {{ value }}-{{ name }}
                </option>
            </select>
        </div>
    </header>
    <section></section>
</section>

</div>