import { useEffect, useRef } from 'react';

declare global {
  interface Window {
    VANTA?: {
      FOG: (options: {
        el: HTMLElement | string;
        mouseControls?: boolean;
        touchControls?: boolean;
        gyroControls?: boolean;
        minHeight?: number;
        minWidth?: number;
        highlightColor?: number;
        midtoneColor?: number;
        lowlightColor?: number;
        baseColor?: number;
        zoom?: number;
      }) => { destroy: () => void };
    };
  }
}

export function useVantaFog() {
  const elRef = useRef<HTMLDivElement>(null);

  useEffect(() => {
    const el = elRef.current;
    if (!el || typeof window === 'undefined') return;

    let effect: { destroy: () => void } | null = null;

    function init() {
      if (!window.VANTA?.FOG || !elRef.current) return;
      effect = window.VANTA.FOG({
        el: elRef.current,
        mouseControls: true,
        touchControls: true,
        gyroControls: false,
        minHeight: 200,
        minWidth: 200,
        highlightColor: 0xc0c0c0,
        midtoneColor: 0xb1a7a7,
        lowlightColor: 0xe2e2e3,
        baseColor: 0x0,
        zoom: 0.6,
      });
    }

    if (window.VANTA?.FOG) {
      init();
    } else {
      const check = setInterval(() => {
        if (window.VANTA?.FOG) {
          clearInterval(check);
          init();
        }
      }, 100);
      return () => {
        clearInterval(check);
        if (effect?.destroy) effect.destroy();
      };
    }

    return () => {
      if (effect?.destroy) effect.destroy();
    };
  }, []);

  return elRef;
}
