
    <div class="flex flex-1 overflow-hidden">
        <button data-drawer-target="sidebar-multi-level-sidebar" data-drawer-toggle="sidebar-multi-level-sidebar" aria-controls="sidebar-multi-level-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
            </svg>
         </button>
      <aside id="sidebar-multi-level-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">

        <div class="p-4 h-full flex flex-col">
          <h2 class="text-lg font-semibold mb-4">Exam Sections</h2>
          <div dir="ltr" class="relative overflow-hidden flex-grow" data-id="17" style="position: relative; --radix-scroll-area-corner-width: 0px; --radix-scroll-area-corner-height: 0px;"
          x-data="{
            icons: {
              'vocabulary': `<i class='w-10 h-10 fa-solid fa-book-open'></i>`,
              'grammer': `<i class='w-10 h-10 fa-solid fa-pen-nib'></i>`,
              'reading':  `<i class='w-10 h-10 fa-regular fa-file-line'></i>`,
              'listening': `<i class='w-10 h-10 fa-solid fa-headphones'></i>`,
            },
            selectedSection: 'vocabulary',
          }"
          >
            <style>[data-radix-scroll-area-viewport]{scrollbar-width:none;-ms-overflow-style:none;-webkit-overflow-scrolling:touch;}[data-radix-scroll-area-viewport]::-webkit-scrollbar{display:none}</style>
            @foreach ($exam->exam_sections as $section)
                <div>
                    <button
                        variant="ghost"
                        class="inline-flex items-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2 w-full"
                        :class="{ 'bg-red-100 text-red-600': selectedSection == '{{ $section['id'] }}' }"
                        {{-- @click="setSelectedSection({{ $section }})" --}}

                    >
                       <span x-html="icons.{{$section['id']}}"></span>
                        <span class="ml-2">{{ $section['title'] }}</span>
                    </button>
                    <div data-orientation="horizontal" role="none" class="shrink-0 bg-border bg-[#E4E4E7] h-[1px] w-full my-2"></div>
                </div>

            @endforeach
        </div>
      </aside>
      <main class="p-4 sm:ml-64">
        <div>Hello World</div>
        {{-- <div class="p-4 lg:hidden">
          <button
            variant="ghost"
            size="icon"
            onClick={() => setSidebarOpen(!sidebarOpen)}
          >
            {sidebarOpen ? <ChevronLeft class="h-4 w-4" /> : <ChevronRight class="h-4 w-4" />}
          </button>
        </div>
        <ScrollArea class="flex-1 p-6">
          <div class="max-w-3xl mx-auto">
            <h1 class="text-2xl font-bold mb-4">{selectedSection.title}</h1>
            <p class="mb-6">{selectedSection.content}</p>
            {selectedSection.questions.map((question) => (
              <div key={question.id} class="bg-gray-100 p-6 rounded-lg mb-6">
                <h2 class="text-xl font-semibold mb-4">Question {question.id}</h2>
                <p class="mb-4">{question.text}</p>
                <div class="space-y-2">
                  {question.options.map((option, index) => (
                    <button key={index} variant="outline" class="w-full justify-start">
                      {String.fromCharCode(65 + index)}. {option}
                    </button>
                  ))}
                </div>
              </div>
            ))}
          </div>
        </ScrollArea> --}}
      </main>
    </div>
