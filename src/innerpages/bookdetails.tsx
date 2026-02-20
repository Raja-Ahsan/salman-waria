import React, { useState, useEffect, useCallback, useRef } from 'react';
import { Document, Page, pdfjs } from 'react-pdf';
import HTMLFlipBook from 'react-pageflip';

// PDF.js worker setup
pdfjs.GlobalWorkerOptions.workerSrc = `//unpkg.com/pdfjs-dist@${pdfjs.version}/build/pdf.worker.min.mjs`;

import 'react-pdf/dist/Page/AnnotationLayer.css';
import 'react-pdf/dist/Page/TextLayer.css';

interface PageProps {
  pageNumber: number;
  width: number;
  height: number;
}

// Memoized Page Wrapper for performance optimization
const PageWrapper = React.memo(React.forwardRef<HTMLDivElement, PageProps>((props, ref) => {
  return (
    <div className="book-page" ref={ref} data-density="soft">
      <div className="page-content">
        <Page
          pageNumber={props.pageNumber}
          width={props.width}
          height={props.height}
          renderTextLayer={false}
          renderAnnotationLayer={false}
          loading={
            <div className="page-loader">
              <div className="mini-spinner"></div>
            </div>
          }
        />
        {/* Spine Shadow Effect */}
        <div className="page-shadow"></div>
      </div>
    </div>
  );
}));

const BookDetails: React.FC = () => {
  const [numPages, setNumPages] = useState<number | null>(null);
  const [currentPage, setCurrentPage] = useState(0);
  const [isMobile, setIsMobile] = useState(window.innerWidth < 768);
  const [dimensions, setDimensions] = useState({
    width: 550,
    height: 750,
  });

  const flipBookRef = useRef<any>(null);

  // Handle responsiveness
  const handleResize = useCallback(() => {
    const width = window.innerWidth;
    const mobile = width < 768;
    
    // If view mode changes, we might want to reset certain things
    if (mobile !== isMobile) {
      setIsMobile(mobile);
    }

    if (mobile) {
      // Mobile: Full width minus some padding
      const newWidth = Math.min(width - 20, 450);
       // Use a standard portrait ratio or calculate from first page
      const ratio = 1.414; // A4 ratio is common for PDFs
      setDimensions({
        width: newWidth,
        height: Math.floor(newWidth * ratio),
      });
    } else {
      // Desktop: Spread view
      // Available width for ONE page in the spread
      const availableWidth = Math.min((width - 240) / 2, 550);
      const ratio = 1.414;
      setDimensions({
        width: Math.floor(availableWidth),
        height: Math.floor(availableWidth * ratio),
      });
    }
  }, [isMobile]);

  useEffect(() => {
    handleResize();
    const debouncedResize = () => {
      clearTimeout((window as any).resizeTimeout);
      (window as any).resizeTimeout = setTimeout(handleResize, 100);
    };
    window.addEventListener('resize', debouncedResize);
    return () => window.removeEventListener('resize', debouncedResize);
  }, [handleResize]);

  const onDocumentLoadSuccess = ({ numPages }: { numPages: number }) => {
    setNumPages(numPages);
  };

  const onFlip = (e: any) => {
    setCurrentPage(e.data);
  };

  const prevPage = () => {
    flipBookRef.current?.pageFlip().flipPrev();
  };

  const nextPage = () => {
    flipBookRef.current?.pageFlip().flipNext();
  };

  // Re-mount flipbook when switching modes to prevent layout distortion
  const flipbookKey = isMobile ? 'mobile' : 'desktop';

  return (
    <div className="book-details-viewer">
 
      <div className="viewer-container">
        <h1 className="book-viewer-heading">WORLD, IN 2050</h1>
        
        <Document
          file="/book.pdf"
          onLoadSuccess={onDocumentLoadSuccess}
          loading={<div className="book-loader">Opening Book...</div>}
        >
          {numPages && (
            <div className="flipbook-wrapper">
              {/* Navigation Arrows */}
              <button 
                className="nav-arrow prev" 
                onClick={prevPage}
                disabled={currentPage === 0}
                aria-label="Previous Page"
              >
                <span>&lt;</span>
              </button>

              <HTMLFlipBook
                key={flipbookKey}
                width={dimensions.width}
                height={dimensions.height}
                size="fixed"
                minWidth={100}
                maxWidth={1200}
                minHeight={100}
                maxHeight={2000}
                drawShadow={true}
                flippingTime={isMobile ? 600 : 800} // Snappier on mobile
                usePortrait={isMobile}
                startPage={0}
                showCover={false}
                autoSize={true}
                maxShadowOpacity={0.4}
                mobileScrollSupport={true}
                onFlip={onFlip}
                ref={flipBookRef}
                className="pdf-flipbook"
                style={{ backgroundColor: 'transparent' }}
                startZIndex={0}
                clickEventForward={true}
                useMouseEvents={true}
                swipeDistance={isMobile ? 15 : 30} // Easier to swipe on mobile
                showPageCorners={!isMobile} // Less accidental flips on mobile
                disableFlipByClick={false}
              >
                {Array.from(new Array(numPages), (_, index) => (
                  <PageWrapper
                    key={`page_${index + 1}`}
                    pageNumber={index + 1}
                    width={dimensions.width}
                    height={dimensions.height}
                  />
                ))}
              </HTMLFlipBook>

              <button 
                className="nav-arrow next" 
                onClick={nextPage}
                disabled={currentPage >= numPages - (isMobile ? 1 : 2)}
                aria-label="Next Page"
              >
                <span>&gt;</span>
              </button>
            </div>
          )}
        </Document>

        {/* Floating Page Counter */}
        {numPages && (
          <div className="page-counter">
            <span>
              {isMobile 
                ? `Page ${currentPage + 1} of ${numPages}`
                : `Pages ${currentPage + 1}-${Math.min(currentPage + 2, numPages)} of ${numPages}`
              }
            </span>
          </div>
        )}
      </div>
    </div>
  );
};

export default BookDetails;