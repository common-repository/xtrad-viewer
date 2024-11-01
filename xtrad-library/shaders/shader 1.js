{
"fragment": "uniform float time;\nvarying vec2 vUv;\nvoid main( void ) {\nvec2 position = - 1.0 + 2.0 * vUv;\nfloat red = abs( sin( position.x * position.y + time / 5.0 ) );\nfloat green = abs( sin( position.x * position.y + time / 4.0 ) );\nfloat blue = abs( sin( position.x * position.y + time / 3.0 ) );\ngl_FragColor = vec4( red, green, blue, 1.0 );\n}",
"vertex": "varying vec2 vUv;\nvoid main()\n{\nvUv = uv;\nvec4 mvPosition = modelViewMatrix * vec4( position, 1.0 );\ngl_Position = projectionMatrix * mvPosition;\n}",
"uniforms": "{\"time\":{\"value\":1}}",
"uniformScript": "this.children[i].material.uniforms.time.value += delta;\n",
"uniformScriptText": "this.children[0].material[0].uniforms.time.value += delta * 2.0;\nthis.children[0].material[1].uniforms.time.value += delta * 2.0;\n",
"uniformScriptBackground": "this.background.backgroundObject.uniforms.time.value += delta;\n"
}