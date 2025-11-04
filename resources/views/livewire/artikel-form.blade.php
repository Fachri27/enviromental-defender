<div>
    <div class="max-w-3xl mx-auto pb-10" x-data="{ lang: 'id' }">
        {{-- Notifikasi sukses --}}
        @if (session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-2 rounded-lg mb-4">
            {{ session('success') }}
        </div>
        @endif

        {{-- Card Form --}}
        <div class="bg-white shadow-sm p-6 space-y-6">

            <div class="flex justify-between items-center">
                <h1 class="text-lg font-semibold text-gray-700">
                    {{ $artikelId ? 'Edit Artikel' : 'Tambah Artikel' }}
                </h1>
                <a href="{{ route('artikel.index') }}" class="text-sm text-gray-500 hover:text-gray-700">←
                    Kembali</a>
            </div>

            {{-- Language Switch --}}
            <div class="mb-6">
                <label class="font-medium text-gray-700">🌐 Pilih Bahasa</label>
                <select x-model="lang" class="border pr-8 py-2 rounded-lg ml-3">
                    <option value="id">Indonesia</option>
                    <option value="en">English</option>
                </select>
            </div>

            <form wire:submit.prevent="save" class="space-y-5">
                {{-- Title --}}
                <div x-show="lang === 'id'">
                    <div x-data="{
                        title: @js(old('title_id', $title_id ?? '')),
                        slug: @js(old('slug', $slug ?? '')),
                        makeSlug(text) {
                            return text
                                .toLowerCase()
                                .replace(/[^a-z0-9]+/g, '-')
                                .replace(/^-+|-+$/g, '');
                        }
                    }" x-init="if(title && !slug){ slug = makeSlug(title) }">
                        <label class="block text-sm font-medium text-gray-600 mb-1">Title (ID)</label>
                        <input type="text" wire:model="title_id" name="title_id" x-model="title"
                            @input="slug = makeSlug(title)" class="w-full border border-gray-500 rounded p-2">
                        @error('title_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror

                        <label class="block font-medium mb-1 mt-3">Slug</label>
                        <input type="text" name="slug" x-model="slug" readonly
                            class="w-full border border-gray-500 rounded p-2 bg-gray-100">
                    </div>
                </div>

                {{-- Title & Slug (EN) --}}
                <div x-show="lang === 'en'">
                    <div x-data="{
                        title: @js(old('title_en', $title_en ?? '')),
                        makeSlug(text) {
                            return text
                                .toLowerCase()
                                .replace(/[^a-z0-9]+/g, '-')
                                .replace(/^-+|-+$/g, '');
                        }
                    }" x-init="if(title && !slug){ slug = makeSlug(title) }">
                        <label class="block text-sm font-medium text-gray-600 mb-1">Title (EN)</label>
                        <input type="text" wire:model="title_en" name="title_en" x-model="title"
                            @input="slug = makeSlug(title)" class="w-full border border-gray-500 rounded p-2">
                        @error('title_en') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Deskripsi --}}
                {{-- excarpt ID --}}
                <div x-show="lang === 'id'" x-data="{
        deskripsi_id: @entangle('deskripsi_id'),
        initEditor() {
            let self = this;
            if (tinymce.get('deskripsi_editor_id')) tinymce.get('deskripsi_editor_id').remove();
            tinymce.init({
                target: this.$refs.deskripsi_editor_id,
                plugins:'advlist anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount code fullscreen insertdatetime help preview',
                toolbar:'undo redo | styles | bold italic underline strikethrough forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media table | code removeformat | fullscreen preview',
                font_size_formats: '8pt 10pt 12pt 14pt 16pt 18pt 24pt 36pt 48pt',
                menubar:'file edit view insert format tools table',
                skin: 'oxide',
                content_css: false,
                license_key: 'gpl',
                style_formats:[
                    {title:'Text Styles',items:[
                    {title:'Paragraph',format:'p'},
                    {title:'Headings',items:[{title:'H1',format:'h1'},{title:'H2',format:'h2'},{title:'H3',format:'h3'},{title:'H4',format:'h4'},{title:'H5',format:'h5'},{title:'H6',format:'h6'}]},
                    {title:'Inline',items:[{title:'Bold',inline:'b'},{title:'Italic',inline:'i'},{title:'Underline',inline:'u'},{title:'Strikethrough',inline:'strike'}]}
                    ]}
                ],
                block_formats:'Paragraph=p; Heading 1=h1; Heading 2=h2; Heading 3=h3; Heading 4=h4; Heading 5=h5; Heading 6=h6',
                toolbar_sticky:true,
                promotion:false,
                branding:false,
                statusbar:true,
                elementpath:false,
                resize:true,
                forced_root_block:'p',
                setup(editor) {
                editor.on('init', () => {
                    // langsung set nilai awal
                    editor.setContent(self.deskripsi_id || '');
                });
                editor.on('change keyup', () => {
                    self.deskripsi_id = editor.getContent();
                });
            }
            });
        }
     }" x-init="initEditor" wire:ignore>

                    <label class="block font-medium mb-1">Deskripsi ID</label>
                    <textarea x-ref="deskripsi_editor_id" id="deskripsi_editor_id"></textarea>
                    <input type="hidden" name="deskripsi_id" :value="deskripsi_id">
                </div>


                {{-- Excarpt EN --}}
                <div x-show="lang === 'en'" x-data="{
        deskripsi_en: @entangle('deskripsi_en'),
        initEditor() {
            let self = this;
            if (tinymce.get('deskripsi_editor_en')) tinymce.get('deskripsi_editor_en').remove();
            tinymce.init({
                target: this.$refs.deskripsi_editor_en,
                plugins:'advlist anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount code fullscreen insertdatetime help preview',
                toolbar:'undo redo | styles | bold italic underline strikethrough forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media table | code removeformat | fullscreen preview',
                font_size_formats: '8pt 10pt 12pt 14pt 16pt 18pt 24pt 36pt 48pt',
                menubar:'file edit view insert format tools table',
                skin: 'oxide',
                content_css: false,
                license_key: 'gpl',
                style_formats:[
                    {title:'Text Styles',items:[
                    {title:'Paragraph',format:'p'},
                    {title:'Headings',items:[{title:'H1',format:'h1'},{title:'H2',format:'h2'},{title:'H3',format:'h3'},{title:'H4',format:'h4'},{title:'H5',format:'h5'},{title:'H6',format:'h6'}]},
                    {title:'Inline',items:[{title:'Bold',inline:'b'},{title:'Italic',inline:'i'},{title:'Underline',inline:'u'},{title:'Strikethrough',inline:'strike'}]}
                    ]}
                ],
                block_formats:'Paragraph=p; Heading 1=h1; Heading 2=h2; Heading 3=h3; Heading 4=h4; Heading 5=h5; Heading 6=h6',
                toolbar_sticky:true,
                promotion:false,
                branding:false,
                statusbar:true,
                elementpath:false,
                resize:true,
                forced_root_block:'p',
                setup(editor) {
                    editor.on('init', () => {
                        setTimeout(() => {
                            editor.setContent(self.deskripsi_en || '');
                        }, 100);
                    });
                    editor.on('change keyup', () => {
                        self.deskripsi_en = editor.getContent();
                    });
                },
            });
        }
     }" x-init="initEditor" wire:ignore>

                    <label class="block font-medium mb-1">Deskripsi (EN)</label>
                    <textarea x-ref="deskripsi_editor_en" id="deskripsi_editor_en"></textarea>
                    <input type="hidden" name="deskripsi_en" :value="deskripsi_en">
                </div>


                {{-- content section --}}
                <div x-show="lang === 'id'" x-data="{
        content_id: @entangle('content_id'),
        initEditor() {
            let self = this;
            if (tinymce.get('content_editor_id')) tinymce.get('content_editor_id').remove();
            tinymce.init({
                target: this.$refs.content_editor_id,
                plugins:'advlist anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount code fullscreen insertdatetime help preview',
                toolbar:'undo redo | styles | bold italic underline strikethrough forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media table | code removeformat | fullscreen preview',
                font_size_formats: '8pt 10pt 12pt 14pt 16pt 18pt 24pt 36pt 48pt',
                menubar:'file edit view insert format tools table',
                skin: 'oxide',
                content_css: false,
                license_key: 'gpl',
                style_formats:[
                    {title:'Text Styles',items:[
                    {title:'Paragraph',format:'p'},
                    {title:'Headings',items:[{title:'H1',format:'h1'},{title:'H2',format:'h2'},{title:'H3',format:'h3'},{title:'H4',format:'h4'},{title:'H5',format:'h5'},{title:'H6',format:'h6'}]},
                    {title:'Inline',items:[{title:'Bold',inline:'b'},{title:'Italic',inline:'i'},{title:'Underline',inline:'u'},{title:'Strikethrough',inline:'strike'}]}
                    ]}
                ],
                block_formats:'Paragraph=p; Heading 1=h1; Heading 2=h2; Heading 3=h3; Heading 4=h4; Heading 5=h5; Heading 6=h6',
                toolbar_sticky:true,
                promotion:false,
                branding:false,
                statusbar:true,
                elementpath:false,
                resize:true,
                forced_root_block:'p',
                setup(editor) {
                editor.on('init', () => {
                    // langsung set nilai awal
                    editor.setContent(self.content_id || '');
                });
                editor.on('change keyup', () => {
                    self.content_id = editor.getContent();
                });
            }
            });
        }
     }" x-init="initEditor" wire:ignore>

                    <label class="block font-medium mb-1">Content ID</label>
                    <textarea x-ref="content_editor_id" id="content_editor_id"></textarea>
                    <input type="hidden" name="content_id" :value="content_id">
                </div>


                {{-- Content EN --}}
                <div x-show="lang === 'en'" x-data="{
        content_en: @entangle('content_en'),
        initEditor() {
            let self = this;
            if (tinymce.get('content_editor_en')) tinymce.get('content_editor_en').remove();
            tinymce.init({
                target: this.$refs.content_editor_en,
                plugins:'advlist anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount code fullscreen insertdatetime help preview',
                toolbar:'undo redo | styles | bold italic underline strikethrough forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media table | code removeformat | fullscreen preview',
                font_size_formats: '8pt 10pt 12pt 14pt 16pt 18pt 24pt 36pt 48pt',
                menubar:'file edit view insert format tools table',
                skin: 'oxide',
                content_css: false,
                license_key: 'gpl',
                style_formats:[
                    {title:'Text Styles',items:[
                    {title:'Paragraph',format:'p'},
                    {title:'Headings',items:[{title:'H1',format:'h1'},{title:'H2',format:'h2'},{title:'H3',format:'h3'},{title:'H4',format:'h4'},{title:'H5',format:'h5'},{title:'H6',format:'h6'}]},
                    {title:'Inline',items:[{title:'Bold',inline:'b'},{title:'Italic',inline:'i'},{title:'Underline',inline:'u'},{title:'Strikethrough',inline:'strike'}]}
                    ]}
                ],
                block_formats:'Paragraph=p; Heading 1=h1; Heading 2=h2; Heading 3=h3; Heading 4=h4; Heading 5=h5; Heading 6=h6',
                toolbar_sticky:true,
                promotion:false,
                branding:false,
                statusbar:true,
                elementpath:false,
                resize:true,
                forced_root_block:'p',
                setup(editor) {
                    editor.on('init', () => {
                        setTimeout(() => {
                            editor.setContent(self.content_en || '');
                        }, 100);
                    });
                    editor.on('change keyup', () => {
                        self.content_en = editor.getContent();
                    });
                },
            });
        }
     }" x-init="initEditor" wire:ignore>

                    <label class="block font-medium mb-1">Content (EN)</label>
                    <textarea x-ref="content_editor_en" id="content_editor_en"></textarea>
                    <input type="hidden" name="content_en" :value="content_en">
                </div>
                {{-- end content section --}}

                <div class="block text-sm font-medium text-gray-600 mb-1">
                    <label class="block font-medium mb-1">📅 Tanggal Publikasi</label>
                    <input type="date" wire:model="published_at" value="{{ old('published_at', $published_at ?? '') }}"
                        class="w-full border px-3 py-2 focus:ring focus:border-blue-400">
                    @error('published_at') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                {{-- Type --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Type</label>
                        <select wire:model="type" class="w-full border border-gray-500 rounded p-2">
                            <option value="">Pilih Type</option>
                            <option value="action">Action</option>
                            <option value="case">Case</option>
                            <option value="alerta">Alerta</option>
                        </select>
                    </div>


                    {{-- Status --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Status</label>
                        <select wire:model="status" class="w-full border border-gray-500 rounded p-2">
                            <option value="draft">Draft</option>
                            <option value="publish">Publish</option>
                        </select>
                    </div>
                </div>

                <div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Gambar</label>
                        <input type="file" wire:model="image" class="w-full border rounded p-2 cursor-pointer"
                            accept=".jpeg,.jpg,.png,.gif">
                        <div class="mt-3">
                            @if ($image)
                            {{-- Preview gambar baru --}}
                            <img src="{{ $image->temporaryUrl() }}" alt="New Upload Preview"
                                class="w-16 h-16 rounded-full object-cover border">
                            @elseif ($old_image)
                            {{-- Preview gambar lama --}}
                            <img src="{{ asset('storage/' . $old_image) }}" alt="Current Image"
                                class="w-16 h-16 rounded-full object-cover border">
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>