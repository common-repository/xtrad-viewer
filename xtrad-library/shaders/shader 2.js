{
"fragment": "uniform float time;\nvarying vec2 vUv;\nvoid main( void ) {\nvec2 position = vUv;\nfloat color = 0.0;\ncolor += sin( position.x * cos( time / 15.0 ) * 80.0 ) + cos( position.y * cos( time / 15.0 ) * 10.0 );\ncolor += sin( position.y * sin( time / 10.0 ) * 40.0 ) + cos( position.x * sin( time / 25.0 ) * 40.0 );\ncolor += sin( position.x * sin( time / 5.0 ) * 10.0 ) + sin( position.y * sin( time / 35.0 ) * 80.0 );\ncolor *= sin( time / 10.0 ) * 0.5;\ngl_FragColor = vec4( vec3( color, color * 0.5, sin( color + time / 3.0 ) * 0.75 ), 1.0 );\n}",
"vertex": "varying vec2 vUv;\nvoid main()\n{\nvUv = uv;\nvec4 mvPosition = modelViewMatrix * vec4( position, 1.0 );\ngl_Position = projectionMatrix * mvPosition;\n}",
"uniforms": "{\"time\":{\"value\":1}}",
"uniformScript": "this.children[i].material.uniforms.time.value += delta;\n",
"uniformScriptText": "this.children[0].material[0].uniforms.time.value += delta * 2.0;\nthis.children[0].material[1].uniforms.time.value += delta * 2.0;\n",
"uniformScriptBackground": "this.background.backgroundObject.uniforms.time.value += delta;\n"
}