Project goals
=============

OGLplus has been developed with the following goals in mind:

Type safety
-----------

OpenGL defines its symbolic constants as plain numbers of the ``GLenum`` type.
It is pretty easy to to confuse similar-looking constant names like
``GL_LINE`` and ``GL_LINES`` and use them in the wrong place. For example:

.. code-block:: c++

    glPolygonMode(GL_FRONT, GL_LINES);

The second argument in the call above is wrong; correctly it should have been:

.. code-block:: c++

    glPolygonMode(GL_FRONT, GL_LINE);

Such mistakes are made easily, but can be hard to find.

OGLplus defines typed wrappers around GL constants and uses the C++ type system
to check for such mismatches. If a constant is used in a wrong place it results
in a compilation error, instead of a run-time error.

Additionally, OpenGL and OpenAL, etc. identify objects of various kinds
like programs, shaders, textures, buffers, audio sources, etc. by plain integer
values which can again be easily confused:

.. code-block:: c++
    :emphasize-lines: 7

    GLuint shader = glCreateShader(GL_VERTEX_SHADER);
    GLuint program = glCreateProgram();
    
    glShaderSource(shader, ...);
    glCompileShader(shader); // so far so good...

    glAttachShader(shader, program); // run-time error (swapped arguments)

In OGLplus various references to various object kinds are strongly-typed and
mismatching them results in compile-time error:

.. code-block:: c++
    :emphasize-lines: 10

    auto& [gl, GL] = ...
    owned_shader_name shader;
    gl.create_shader(GL.vertex_shader) >> shader;
    owned_program_name;
    gl.create_program() >> program;

    gl.shader_source(shader, ...);
    gl.compile_shader(shader);

    gl.attach_shader(shader, program); // compile error

No preprocessor ifdefs in client code
-------------------------------------

The OpenGL API is heavily versioned and there are many extensions that are
implementation-specific. In such cases users are often checking whether macros
like ``GL_VERSION_3_0`` or ``GL_ARB_compatibility`` are defined and use the C++
preprocessor to switch between implementations using new features or extensions
and fallback implementations using an older GL API:

.. code-block:: c++
    :emphasize-lines: 2

    void myFunction() {
    #ifdef GL_VERSION_4_5
    // use new features here
    #else
    // use legacy API instead
    #endif
    }

This makes the application code ugly and sometimes hard to reason about.

In OGLplus the GL functions, etc. are wrapped in objects that provide additional
functionality besides just calling the wrapped GL operation. For example they
can be converted to boolean value which says whether a function or constant can
be used. This boolean value can be a compile-time constant, so in many cases you
do not pay for the check at run-time and the unused code is completely removed
from the compiled binary. Also you can directly check for the availability
of the function, not for the version:

.. code-block:: c++
    :emphasize-lines: 3

    void myFunction(texture_name tex) {
        auto& [gl, GL] = ...
        if(gl.texture_sub_image2d) {
            // yay, we can use DSA
            gl.texture_sub_image(tex, ...);
        } else {
            // we have to bind
            gl.active_texture(0);
            gl.bind_texture(GL.texture_2d, tex);
            gl.tex_sub_image2d(GL.texture_2d, ...);
        }
    }

TODO

.. toctree::
   :hidden:
