module.exports = {
    presets: [
        [
          '@babel/preset-env',
          {
            useBuiltIns: 'usage',
            corejs: '3.23',
          },
        ],
        '@babel/preset-react',
        // '@babel/preset-validation', // Comenta esta línea si no existe este preset
      ],
      plugins: [
        '@babel/plugin-proposal-class-properties',
        '@babel/plugin-proposal-object-rest-spread',
      ],
  };